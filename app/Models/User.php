<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class User extends Authenticatable
{
    use Notifiable, EntrustUserTrait;

    const ADMIN = 1, TEACHER = 2, PARENT = 3;

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'title',
        'first_name',
        'last_name',
        'email',
        'password',
        'username'
    ];

    /**
     * The attributes that should be hidden for arrays.
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $appends = [ 'is_grade_assigned', 'name' ];

    public function getRouteKeyName()
    {
        return 'username';
    }

    public function getIsGradeAssignedAttribute()
    {
        return Grade::where('class_teacher_id', $this->id)->count() > 0;
    }

    public function scopeType($query, $role_id)
    {
        $users_of_id = DB::table('role_user')->where('role_id', $role_id)->pluck('user_id');

        return $query->whereIn('id', $users_of_id);
    }

    public function getNameAttribute()
    {
        return "{$this->title} {$this->first_name} {$this->last_name}";
    }

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }
}
