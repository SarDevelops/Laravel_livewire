<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Video extends Model
{
    use HasFactory;

    protected $guarded = [];


    public function getRouteKeyName()
    {
        return 'uid';
    }

    public function getThumbnailAttribute()
    {
        if ($this->thumbnail_image) {
            return '/videos/'.$this->uid .'/'. $this->thumbnail_image;
        } else {
            return '/videos/'. 'default.png';
        }
    }

    public function getUpdatedDataAttribute()
    {
        $date = new Carbon($this->created_at);

        return $date->toFormattedDateString();
    }

    /**
     * Get the channel
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function channel()
    {
        return $this->belongsTo(Channel::class);
    }

    /**
     * Get all of the likes for the Video
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    /**
     * Get all of the dislike for the Video
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function dislikes()
    {
        return $this->hasMany(Dislike::class);
    }


    public function doesUserLikedVideo()
    {
        return $this->likes()->where('user_id', auth()->id())->exists();
    }

    public function doesUserDislikeVideo()
    {
        return $this->dislikes()->where('user_id', auth()->id())->exists();
    }

    /**
     * Get all of the comments for the Video
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany(Comment::class)->whereNull('reply_id');
    }

    /**
     * Get all of the AllCommentCount for the Video
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function AllCommentsCount()
    {
        return $this->hasMany(Comment::class)->count();
    }
}
