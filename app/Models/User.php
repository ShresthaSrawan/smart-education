<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'username',
        'role_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $appends = [ 'is_grade_assigned' ];

    public function getRouteKeyName()
    {
        return 'username';
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function isRole($role)
    {
        return $this->role->slug == $role || $this->role_id == $role;
    }

    public function scopeHasRole($query, $role)
    {
        $role_id = Role::whereSlug($role)->firstOrFail()->id;

        return $query->where('role_id', $role_id);
    }

    public function getIsGradeAssignedAttribute()
    {
        return Grade::where('class_teacher_id', $this->id)->count() > 0;
    }
}
