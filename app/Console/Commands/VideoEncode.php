<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
// use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;
use FFMpeg\Format\Video\X264;
use FFMpeg;

class VideoEncode extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'video-encode:start';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Video Encoding...';

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
        $low = (new X264)->setKiloBitrate(500);
        // // $midBitrate = (new X264())->setKiloBitrate(500);
        $high = (new X264)->setKiloBitrate(1000);

        FFMpeg::fromDisk('videos-temp')
        ->open('ajcYv0Ii5LhpftpaS7sJ3MehF87CfGgaZSJEOXx9.mp4')
        ->exportForHLS()
        ->addFormat($low)
        ->addFormat($high)
        ->onProgress(function($progress){
            $this->info("Progress={$progress}%");
        })
        ->toDisk('videos-temp')
        ->save('/test/file.m3u8');
    }
}
