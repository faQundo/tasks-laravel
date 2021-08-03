<?php

namespace App\Models;

use App\Traits\Audit;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory, Audit;

    public function creator() {

        return $this->belongsTo(User::class , 'created_by');
    }

    public function designate() {

        return $this->belongsTo(User::class , 'user_designated_id');
    }

    public function logs()
    {
        return $this->belongsToMany(Log::class, 'task_logs')
            ->using(TaskLog::class)
            ->withTimestamps();
    }
}
