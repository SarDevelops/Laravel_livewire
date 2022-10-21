<?php

namespace App\Http\Livewire\Video;

use Livewire\Component;

class ShowVideo extends Component
{
    public $videos;
    public function mount(Video $videos)
    {
        $this->videos = $videos;
    }
    public function render()
    {
        return view('livewire.video.show-video')->extends('layouts.app');
    }
}
