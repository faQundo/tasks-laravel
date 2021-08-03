<?php

namespace App\Traits;

use Illuminate\Support\Facades\Auth;

trait Audit {

    protected static function bootAudit() {

        static::creating(function ($model) {
            if(Auth::check())
            $model->created_by = Auth::user()->id;
        });

    }

}
