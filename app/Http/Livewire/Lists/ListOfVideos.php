<?php

namespace App\Http\Livewire\Lists;

use Livewire\Component;
use App\Models\Video;
use App\Models\Channel;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
class ListOfVideos extends Component
{


    use AuthorizesRequests;
    protected $paginationTheme = 'bootstrap';

    public $channels;
    public function mount()
    {
        if (Auth::check()) {
            $this->channels = Auth::user()->subscribedChannels()->with('videos')->get()->pluck('videos');
            $this->channels = Channel::get()->pluck('videos');
       }else {
           $this->channels = Channel::get()->pluck('videos');
       }
    }
    public function render()
    {
        return view('livewire.lists.list-of-videos')->with('channels',$this->channels);
    }

}
