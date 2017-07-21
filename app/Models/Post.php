<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['user_id', 'message', 'meta', 'slug'];

    protected $appends = ['created_at_formatted', 'thumbnail'];

    protected $dates = ['created_at'];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function images()
    {
    	return $this->morphMany(Image::class, 'imageable');
    }

    public function getCreatedAtFormattedAttribute()
    {
    	return $this->created_at->diffForHumans();
    }

    public function getThumbnailAttribute()
    {
    	return $this->thumbnail();
    }

    public function thumbnail($width=560, $height=250)
    {
    	return $this->images->count() > 0 ? $this->images->first()->thumbnail($width, $height) : "http://via.placeholder.com/{$width}x{$height}?text=Smart+Education";
    }
}
