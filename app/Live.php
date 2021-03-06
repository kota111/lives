<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Live extends Model
{
    protected $fillable = [
        'title', 'date', 'venue', 'category', 'artist', 'min_fee', 'max_fee', 'url', 'live_image', 'lat', 'lng', 'user_id'
    ];

    // このライブを入力したuser
    public function user()
    {
        return $this->belongsTo(Admin::class);
    }

    // このライブに行ったユーザー
    public function livers()
    {
        return $this->belongsToMany(User::class, 'going', 'live_id', 'user_id')->withTimestamps();
    }

}
