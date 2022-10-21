<?php

namespace App\Http\Livewire\Channel;

use Livewire\Component;
use App\Models\Channel;
use App\Models\Subscription;
use Auth;

class ChannelInfo extends Component
{
    public $channel;

    public $userSubscribed = false;

    public function mount(Channel $channel)
    {
        $this->channel = $channel;

        if (Auth::check()) {
            if (auth()->user()->isSubscribedTo($this->channel))
            {
                $this->userSubscribed = true;
            }
        }
    }
    public function render()
    {
        return view('livewire.channel.channel-info')->extends('layouts.app');
    }

    public function toggle(){

        if (!Auth::check()) {
            return redirect('/login');
        }
        if (auth()->user()->isSubscribedTo($this->channel)) {
            Subscription::where('user_id',auth()->id())->where('channel_id',$this->channel->id)->delete();
            $this->userSubscribed = false;
        }else{
            Subscription::Create([
                'user_id'=>auth()->id(),
                'channel_id'=>$this->channel->id,
            ]);
            $this->userSubscribed = true;
        }
    }
}