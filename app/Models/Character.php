<?php

namespace App\Models;

use Illuminate\Database\Eloquent\{Model, Builder};
use Cache;
use GuzzleHttp\Client as Guzzle;

class Character extends Model
{
    public $fillable = ['item_level', 'level', 'server', 'account_id', 'c_rest', 'g_rest', 'name', 'sequence', 'class', 'description'];

    protected static function booted()
    {
        parent::boot();

        static::addGlobalScope('sequence', function(Builder $query) {
            $query->orderBy('sequence', 'desc');
        });
    }

    /**
     * week work 관계성
     *
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function week()
    {
        return $this->hasMany(WeekWork::class, 'target_id', 'id')->where('type', 'account')->where('week', now()->addDays(-2)->format('YW'));
    }

    /**
     * day work 관계성
     *
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function day()
    {
        return $this->hasMany(DayWork::class, 'character_id', 'id')->where('day', now()->format('YWw'));
    }

    public function getClassImageAttribute()
    {
        $class = Classes::all()->where('name', $this->class)->first();
        if ($class) {
            return $class->image;
        } else {
            return '';
        }
    }

    public function getBuffAttribute()
    {
        Cache::pull('character_buff_'.$this->getKey());

        return Cache::remember('character_buff_'.$this->getKey(), 300, function() {
            $response = (new Guzzle)->request('get', 'https://lostark.game.onstove.com/Profile/Character/'.$this->name);
            $script = str_get_html((string) $response->getBody())->find('script')[2]->innerText();
            $json = str_replace('$.Profile = ', '', $script);

            // 악세
            $accessory = [];
            preg_match_all('/Element_007(.*)\n.*\n.*\n.*무작위 각인 효과.*\n.*/', $json, $match);
            foreach ($match[0] as $acc) {
                $temp = [];
                preg_match_all('/\[\<FONT COLOR=\'#[0-9A-Z]{6}\'>(?<name>[ 가-홯]{1,100})\<\/FONT\>\] 활성도 \+(?<level>\d)/', $acc, $match);
                foreach ($match[0] as $i => $acc1) {
                    $temp[$match['name'][$i]] = $match['level'][$i];
                }
                $accessory[] = $temp;
            }

            // 각인서
            $book = [];
            preg_match_all('/Element_002(.*)\n.*\n.*장착 시 캐릭터에.*/', $json, $match);
            foreach ($match[0] as $row) {
                preg_match_all('/\<FONT COLOR=\'#FFFFAC\'\>(?<name>[ 가-홯]{1,})\<\/FONT\>[ A-z가-홯]{1,}\<FONT COLOR=\'#FFD200\'\>(?<level>[0-9]{1,2})\<\/FONT>/', $row, $match);
                $book[$match['name'][0]] = $book[$match['name'][0]] ?? 0;
                $book[$match['name'][0]] += $match['level'][0];
            }

            // 돌
            $stone = [];
            preg_match('/Element_005.*\n.*\n.*\n.*무작위 각인 효과.*\n.*/', $json, $match);
            preg_match_all('/\<FONT COLOR=\'#FFFFAC\'\>(?<name>[ 가-홯]{1,})\<\/FONT\>\] 활성도 \+(?<level>[0-9]{1,2})/', $match[0], $match);
            foreach ($match[0] as $i => $row) {
                $stone[$match['name'][$i]] = $match['level'][$i];
            }

            return compact('accessory', 'book', 'stone');
        });
    }

    public function activeBuffSort()
    {
        $buffSum = [];
        foreach ($this->buff['accessory'] as $acc) {
            foreach ($acc as $name => $level) {
                $buffSum[$name] = $buffSum[$name] ?? 0;
                $buffSum[$name] += $level;
            }
        }

        foreach ($this->buff['book'] as $name => $level) {
            $buffSum[$name] = $buffSum[$name] ?? 0;
            $buffSum[$name] += $level;
        }

        foreach ($this->buff['stone'] as $name => $level) {
            $buffSum[$name] = $buffSum[$name] ?? 0;
            $buffSum[$name] += $level;
        }

        foreach ($buffSum as $key => $value) {
            if ($value < 5) {
                unset($buffSum[$key]);
            }
        }

        arsort($buffSum);

        return $buffSum;
    }

    public function account()
    {
        return $this->hasOne(Account::class, 'id', 'account_id');
    }

    public function isHasScope()
    {
        return $this->account->user_id !== \Auth::id();
    }
}
