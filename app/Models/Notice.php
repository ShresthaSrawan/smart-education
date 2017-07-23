<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notice extends Model
{
    protected $fillable = [ 'user_id', 'title', 'message', 'meta', 'notify', 'slug' ];

    protected $casts = [ 'meta' => 'array' ];

    /**
     * Recipients of the notice
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function recipients()
    {
        return $this->belongsToMany(User::class);
    }

    /**
     * Issuer of the notice
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * set the title and a suitable unique slug
     *
     * @param $value
     */
    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;

        if ( ! $this->exists)
        {
                $this->attributes['slug'] = 'NOT-' . date('Ymdhis') . '-' . str_random(5);
        }
    }
}
