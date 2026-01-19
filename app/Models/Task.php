<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use softDeletes;

    protected $fillable = [
        'title',
        'description',
        'status',
        'assigned_to_id',
        'creator_id',
    ];
    protected $table = 'tasks';

    public function assignedUser()
    {
        return $this->belongsTo(User::class, 'assigned_to_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id');
    }

    public function task()
    {
        return $this->belongsTo(Task::class, 'task_id');
    }

    public function comments()
    {
        return $this->hasMany(Comments::class, 'task_id');
    }

    public function tasks()
    {
        return $this->hasMany(Task::class, 'task_id');
    }

    public function taskStatus()
    {
        return $this->status;
    }

}
