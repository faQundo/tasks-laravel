<?php

namespace App\Models;

use App\Traits\Audit;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Notifications\LogCreated;


class Log extends Model
{
    use HasFactory, Audit;

    public function creator() {

        return $this->belongsTo(User::class , 'created_by');
    }

    public static function boot()
    {
        self::created(function ($model) {
            $user = User::find($model->created_by);
            $user->notify(
                new LogCreated($user)
            );

        });
        parent::boot();
    }
}
