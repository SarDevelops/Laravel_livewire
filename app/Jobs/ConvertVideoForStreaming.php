<?php

namespace App\Jobs;

use App\Models\Video;
use FFMpeg\Format\Video\X264;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;
use Illuminate\Support\Facades\Storage;

class ConvertVideoForStreaming implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public $video;

    public function __construct(Video $video)
    {
        $this->video = $video;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $destination =
            '/' . $this->video->uid . '/' . $this->video->uid . '.m3u8';
        $low = (new X264())->setKiloBitrate(500);
        // // $midBitrate = (new X264())->setKiloBitrate(500);
        $high = (new X264())->setKiloBitrate(1000);
        $media = FFMpeg::fromDisk('videos-temp')
            ->open($this->video->path)
            ->exportForHLS()
            ->addFormat($low)
            ->addFormat($high)
            ->onProgress(function ($progress) {
                $this->video->update([
                    'processing_percentage' => $progress,
                ]);
                // $this->info("Progress={$progress}%");
            })
            ->toDisk('videos')
            ->save($destination);
            $seconds = $media->getDurationInSeconds();
        $this->video->update([
            'processed' => true,
            'processed_file' => $this->video->uid . '.m3u8',
            'duration' => $this->formatDuration($seconds)
        ]);

        //delete temp video
        $res = Storage::disk('videos-temp')->delete($this->video->path);
        \Log::info($this->video->path . 'this video is delete');
    }

    public function formatDuration($seconds)
    {
        $duration = gmdate('H:i:s', $seconds);
        return $duration;
    }
}
