<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\{Character, Los};

class restIncrement extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rest:increment';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        if (\Cache::get('laset_rest_increnent') == now()->format('YWw')) {
 //           $this->error('오늘꺼 이미 작업함');
        }
        \Cache::put('laset_rest_increnent', now()->format('YWw'));

        foreach (Character::all() as $character) {
            if ($character->day->where('content', '카던')->count() == 0) {
                $character->c_rest += 20;
                if ($character->c_rest > 100) {
                    Los::create([
                        'character_id' => $character->getKey(),
                        'date' => now()->format('YWw'),
                        'rest' => 100 - $character->c_rest,
                        'type' => '카던',
                    ]);
                    $character->c_rest = 100;
                }
            }

            if ($character->day->where('content', '가디언')->count() == 0) {
                $character->g_rest += 20;
                if ($character->g_rest > 100) {
                    Los::create([
                        'character_id' => $character->getKey(),
                        'date' => now()->format('YWw'),
                        'rest' => 100 - $character->g_rest,
                        'type' => '가디언',
                    ]);
                    $character->g_rest = 100;
                }
            }

            if ($character->day->where('content', '에포나')->count() == 0) {
                $character->a_rest += 30;
                if ($character->a_rest > 100) {
                    Los::create([
                        'character_id' => $character->getKey(),
                        'date' => now()->format('YWw'),
                        'rest' => 100 - $character->a_rest,
                        'type' => '에포나',
                    ]);
                    $character->a_rest = 100;
                }
            }
            $character->save();
        }
    }
}
