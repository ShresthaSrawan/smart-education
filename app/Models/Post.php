<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['user_id', 'message', 'meta', 'slug'];

    protected $appends = ['created_at_formatted', 'thumbnail'];

    protected $dates = ['created_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function images()
    {
    	return $this->morphMany(Image::class, 'imageable');
    }

    /**
     * @return mixed
     */
    public function getCreatedAtFormattedAttribute()
    {
    	return $this->created_at->diffForHumans();
    }

    /**
     * @return string
     */
    public function getThumbnailAttribute()
    {
    	return $this->thumbnail();
    }

    /**
     * @param int $width
     * @param int $height
     * @return string
     */
    public function thumbnail($width=560, $height=250)
    {
    	return $this->images->count() > 0 ? $this->images->first()->thumbnail($width, $height) : "http://via.placeholder.com/{$width}x{$height}?text=Smart+Education";
    }

    /**
     * Set the message attribute and the slug.
     *
     * @param string $value
     */
    public function setMessageAttribute($value)
    {
        $this->attributes['message'] = $value;

        if ( ! $this->exists)
        {
            $this->attributes['slug'] = 'POS-' . date('Ymdhis') . '-' . str_random(5);
        }
    }

    public function tags()
    {
        return $this->hasMany(Tag::class);
    }

    public function scopeRelatedTo($query, User $user)
    {
        return $query->where('user_id', $user->id);
    }
}
