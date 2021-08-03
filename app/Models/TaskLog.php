<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class TaskLog extends Pivot
{

    protected $table = 'task_logs';

    protected $fillable = [
        'id',
        'task_id',
        'log_id',
        'created_at',
        'updated_at',
    ];

    public function task()
    {
        return $this->belongsTo(Task::class);
    }

    public function log()
    {
        return $this->belongsTo(Log::class);
    }
}
