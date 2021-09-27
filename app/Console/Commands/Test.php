<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class Test extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test';

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
        $players = 100;
        $success = 3;
        $r = 0;
        $result1 = [];
        $result2 = [];
        while ($r < 100) {
            $result1[] = round($r, 3);
            $players = $players - ($players * ($success / 100));
            $r += $success / 2;
            $result2[] = round(100 - $players, 3);
        }
        dd(json_encode($result1), json_encode($result2));
    }
}
