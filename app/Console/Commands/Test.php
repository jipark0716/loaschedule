<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Storage;

class Test extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test {bucket}';

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
        $storage = Storage::createS3Driver(array_merge(config('filesystems.disks.s3'), [
            'bucket' => $this->argument('bucket')
        ]));

        $files = $storage->files();

        $bar = $this->output->createProgressBar(count($files));
        $bar->start();

        foreach ($files as $fileName) {
            if (!Storage::disk('ftp')->exists('byapps-app-popbanner/'.$fileName)) {
                Storage::disk('ftp')->put('byapps-app-popbanner/'.$fileName, $storage->get($fileName));
            }
            $bar->advance();
        }
        $bar->finish();

        $this->info('success');
    }
}
