<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [ 'user_id', 'message', 'meta', 'slug' ];

    protected $appends = [ 'created_at_formatted', 'thumbnail' ];

    protected $dates = [ 'created_at' ];

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
    public function thumbnail($width = 560, $height = 250)
    {
        return $this->images->count() > 0 ? $this->images->first()->thumbnail($width, $height) : "http://via.placeholder.com/{$width}x{$height}?text=Smart+Education";
    }

    /**
     * Set the message attribute and the slug.
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

    /**
     * Get posts related to the given user
     * for parents the post should be
     * created by
     * tagged with the same grade as the students associated with the parent
     * for teachers the post should be
     * created by
     * tagged with the same grade as the teacher is associated with
     * @param $query
     * @param User $user
     * @return mixed
     */
    public function scopeRelatedTo($query, User $user)
    {
        $filtered        = $query;
        $filterByGrade   = [];
        $filterBySubject = [];
        // if user is a parent
        if ($user->children()->count() > 0)
        {
            $filterByGrade   = $user->children()->with('grade')->get()->pluck('grade.id')->toArray();
            $filterBySubject = $user->children()->with('grade.subjects')->get()->pluck('grade.subjects')->flatten()->pluck('id')->toArray();
        }

        // if user is a teacher
        if ($user->subjects()->count() > 0)
        {
            $filterByGrade   = array_unique(array_merge($filterByGrade, $user->subjects()->with('grade')->get()->pluck('grade.id')->toArray()));
            $filterBySubject = array_unique(array_merge($filterBySubject, $user->subjects()->pluck('id')->toArray()));
        }

        if (count($filterByGrade) > 0)
        {
            $filtered = $filtered->whereHas('tags', function ($q) use ($filterByGrade) {
                $q->type(Grade::class, $filterByGrade);
            });
        }

        if (count($filterBySubject) > 0)
        {
            $filtered = $filtered->whereHas('tags', function ($q) use ($filterBySubject) {
                $q->type(Subject::class, $filterBySubject);
            });
        }

        $filtered = $filtered->orWhere('user_id', $user->id);

        return $filtered;
    }
}
