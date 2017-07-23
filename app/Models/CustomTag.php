<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomTag extends Model
{
    protected $fillable = [ 'name', 'slug' ];

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;

        if ( ! $this->exists)
        {
            $this->attributes['slug'] = 'TAG-' . date('Ymdhis') . '-' . str_random(5);
        }
    }

    public function tags()
    {
        $this->morphMany(Tag::class, 'tagable');
    }
}
