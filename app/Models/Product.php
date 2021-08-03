<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function invoice() {

        return $this->belongsTo(Invoice::class);
    }

    public static function boot()
    {
        static::saved(function ($model){

            $invoice_id = $model->invoice_id;

            $model->invoice->total = Invoice::query()
                ->where('invoice_id','=',$invoice_id)
                ->sum('total');

            $model->invoice->save();
        });

        static::deleted(function ($model){
            $package_resource_id =$model->package_resource_id;

            $model->invoice->total = Invoice::query()
                ->where('invoice_id','=',$invoice_id)
                ->sum('total');

            $model->invoice->save();
        });

        parent::boot();
    }
}
