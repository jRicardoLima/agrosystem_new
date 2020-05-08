<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductEntry extends Model
{
    use SoftDeletes;
    protected $table = "products_entry";

    protected $fillable = [
        'product_id_entry',
        'quantity'
    ];

    public function productRelation()
    {
        return $this->belongsTo(Product::class,'product_id_entry','id');
    }

    public function setQuantityAttribute($value)
    {
        $this->attributes['quantity'] = floatval(converStringToDouble($value));
    }

    public function getCreatedAtAttribute($value)
    {
        return $this->attributes['created_at'] = convertDateTimeToBr($value);
    }
}
