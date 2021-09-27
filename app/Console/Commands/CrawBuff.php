<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use GuzzleHttp\Client as Guzzle;
use Cache;

class CrawBuff extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'craw:buff';

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
        $result = [];

        $response = (new Guzzle)->request('get', 'https://loawa.com/library_seal/');
        $buffObjs = str_get_html((string) $response->getBody())->find('[name^=set]');
        foreach ($buffObjs as $buffObj) {
            preg_match('/\&nbsp;(?<name>.*)$/', $buffObj->innerText(), $match);
            if (!isset($match['name']) || !($imgObj = $buffObj->find('img')[0])) {
                continue;
            }
            $result[$match['name']] = 'https://loawa.com/'.$imgObj->attr['src'];
        }

        Cache::forever('buffs', $result);
    }
}
