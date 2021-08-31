<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use GuzzleHttp\Client as Guzzle;

class Account extends Model
{
    public $fillable = ['nick_name', 'main_character'];

    /**
     * 원정대 캐릭터 수집
     *
     * @return boolean
     */
    public function crawCharacter()
    {
        $response = (new Guzzle)->request('get', 'https://lostark.game.onstove.com/Profile/Character/'.$this->main_character);
        $dom = str_get_html((string) $response->getBody())->find('#expand-character-list');
        if (count($dom) == 0) {
            return false;
        }
        $server = '';
        $names = [];
        $seq = 0;
        foreach ($dom[0]->children as $children) {
            if ($children->attr['class'] == 'profile-character-list__server') {
                $server = str_replace('@', '', $children->innerText());
            } elseif ($children->attr['class'] == 'profile-character-list__char') {
                foreach ($children->children as $character) {
                    preg_match('/ *alt=\\".*\\"\\>Lv.(?<level>\\d*)\\<span\\>/', $character->find('button')[0]->innerText(), $match);
                    $name = $character->find('button span')[0]->innerText();
                    $names[] = $name;
                    $className = $character->find('img')[0]->attr['alt'];
                    $classImage = $character->find('img')[0]->attr['src'];
                    $class = Classes::where('name', $className)->first();
                    if ($class == null) {
                        Classes::create([
                            'name' => $className,
                            'image' => $classImage,
                        ]);
                    }
                    if ($char = Character::where('name', $name)->first()) {
                        $char->fill([
                            'level' => $match['level'],
                            'class' => $className,
                            'sequence' => $seq++,
                            'item_level' => $this->getItemLevel($character->find('button span')[0]->innerText()),
                        ]);
                        $char->save();
                    } else {
                        Character::create([
                            'account_id' => $this->getKey(),
                            'server' => $server,
                            'class' => $className,
                            'name' => $name,
                            'sequence' => $seq++,
                            'level' => $match['level'],
                            'item_level' => $this->getItemLevel($character->find('button span')[0]->innerText()),
                        ]);
                    }
                }
            }
        }
        Character::where('account_id', $this->getKey())
            ->whereNotIn('name', $names)
            ->delete();
        return $this->character;
    }

    /**
     * get item level
     *
     * @param string $name
     * @return int
     */
    public function getItemLevel($name)
    {
        $response = (new Guzzle)->request('get', 'https://lostark.game.onstove.com/Profile/Character/'.$name);
        $dom = str_get_html((string) $response->getBody());
        preg_match('/\\<\\/small\\>(?<level>[0-9|\\,]{1,5})/', $dom->find('.level-info2__expedition')[0]->innertext(), $match);
        return (int) str_replace(',', '', $match['level']);
    }

    /**
     * character 관계성
     *
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function character()
    {
        return $this->hasMany(Character::class, 'account_id', 'id');
    }

    /**
     * get nick name attribute
     *
     * @return string
     */
    public function getNickNameAttribute($val)
    {
        return $val ?: $this->main_character;
    }
}
