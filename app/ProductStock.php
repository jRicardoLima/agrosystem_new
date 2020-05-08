<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductStock extends Model
{
    use SoftDeletes;
    protected $table = "products_stock";

    protected $fillable = [
        'product_id_stock',
        'quantity_current',
    ];

    public function productRelation()
    {
        return $this->belongsTo(Product::class,'product_id_stock','id');
    }

    public function getCreatedAtAttribute($value)
    {
        return $this->attributes['created_at'] = convertDateTimeToBr($value);
    }

    public function getupdatedAtAttribute($value)
    {
        return $this->attributes['updated_at'] = convertDateTimeToBr($value);
    }
}
