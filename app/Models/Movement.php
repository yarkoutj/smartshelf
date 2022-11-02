<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Movement extends Eloquent
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'movements';

    //Relación de muchos a uno
    public function product(){
        return $this->belongsTo('App\Models\Product','product_id');
    }//Relación de muchos a uno
    public function shelf(){
        return $this->belongsTo('App\Models\Shelf','shelf_id');
    }
}
