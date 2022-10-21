<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Video;



class Channel extends Model

{
    use HasFactory;
    protected $guarded = [];

    public function getRouteKeyName()
    {

        return 'slug';
    }
    public function user()
    {

        return $this->belongsTo(User::class);
    }

    /**
     * Get all of the comments for the Channel
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function videos()
    {
        return $this->hasMany(Video::class);
    }

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }

    public function subscribers()
    {
        return $this->subscriptions->count();
    }

}
