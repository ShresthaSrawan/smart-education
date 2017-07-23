<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = [ 'post_id', 'tagable_type', 'tagable_id' ];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function tagable()
    {
        return $this->morphTo();
    }
}
