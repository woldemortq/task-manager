<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Model
{
    use softDeletes;
    protected $table = 'users';

    //пока что в виде заглушки, позже переделаю для $fillable
    protected $guarded = [];
    protected $hidden = ['password'];



    public function isAdmin(): bool
    {
        return $this->role === 'Admin';
    }
    public function isUser(): bool
    {
        return $this->role === 'User';
    }

    public function tasks()
    {
        return $this->hasMany(Task::class, 'task_id');
    }

}
