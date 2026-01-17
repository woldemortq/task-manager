<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use softDeletes;
    protected $table = 'users';

    use Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'telegram_chat_id',
        'telegram_username',
        'telegram_auth_code',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];



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
