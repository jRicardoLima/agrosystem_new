<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoice extends Model
{
    use SoftDeletes;
    protected $table = "invoices";

    protected $fillable = [
        'product_id',
        'access_key',
        'path'
    ];

    public function productRelation()
    {
        return $this->belongsTo(Product::class,'product_id','id');
    }
}
