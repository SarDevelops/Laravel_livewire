<?php

namespace App\Http\Livewire\Video;

// use Livewire\WithFileUploads;
use App\Models\Channel;
use App\Models\Video;
use Livewire\Component;

class EditVideo extends Component
{
    // use WithFileUploads;
    public Channel $channel;
    public Video $video;
    // public $videoFile;

    protected $rules = [
        'video.title' => 'required|max:255',
        'video.description' => 'required|max:1000',
        'video.visibility' => 'required|in:private,public,unlisted',
    ];


    public function mount($channel , $video)
    {
        $this->channel = $channel;
        $this->video = $video;
    }

    public function render()
    {
        return view('livewire.video.edit-video')->extends('layouts.app');
    }

    public function update()
    {
        // dd($this->video->visibility);
        $this->validate();

        //update record

        $this->video->update([
            'title' => $this->video->title,
            'description' => $this->video->description,
            'visibility' => $this->video->visibility
        ]);

        session()->flash('message', 'video updated');
    }
}
