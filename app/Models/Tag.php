<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = [ 'post_id', 'tagable_type', 'tagable_id' ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function tagable()
    {
        return $this->morphTo();
    }

    /**
     * @param $query
     * @param $type
     * @param bool $ids
     * @return mixed
     */
    public function scopeType($query, $type, $ids = false)
    {
        $filtered = $query->where('tagable_type', $type);
        if ( ! $ids)
        {
            return $filtered;
        }

        if(is_array($ids))
            $filtered->whereIn('tagable_id', $ids);
        else
            $filtered->where('tagable_id', $ids);

        return $filtered;
    }
}
