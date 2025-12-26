<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use softDeletes;

    //пока что в виде заглушки, позже переделаю для $fillable
    protected $guarded = [];
    protected $table = 'tasks';


    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_by');
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
