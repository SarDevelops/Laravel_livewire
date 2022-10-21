<?php

namespace App\Http\Livewire\Video;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Video;
use App\Models\Channel;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Storage;

class AllVideo extends Component
{

    use WithPagination;
    use AuthorizesRequests;
    protected $paginationTheme = 'bootstrap';

    public $channel;
    public function mount(Channel $channel)
    {
        $this->channel = $channel;
    }
    public function render()
    {
        return view('livewire.video.all-video')
            ->with('videos', $this->channel->videos()->paginate(3))
            ->extends('layouts.app');
    }



    public function delete(Video $video)
    {
        //check if user is allowd to delete video

        $this->authorize('delete',$video);

        //delete Folder
        // dd($video->uid);

        $deleted =  Storage::disk('videos')->deleteDirectory($video->uid);
        // dd($deleted);
        if ($deleted) {
            $video->delete();
        }
        return back();
    }
}
