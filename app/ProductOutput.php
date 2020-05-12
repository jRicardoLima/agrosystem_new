<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductOutput extends Model
{
    use SoftDeletes;
    protected $table = "products_output";

    protected $fillable = [
      'product_id_output',
      'quantity',
      'unity_id'
    ];

    public function productRelation()
    {
        return $this->belongsTo(Product::class,'product_id_output','id');
    }

    public function unityRelation()
    {
        return $this->belongsTo(Unity::class,'unity_id','id');
    }
    public function getCreatedAtAttribute($value)
    {
        return $this->attributes['created_at'] = convertDateTimeToBr($value);
    }
}
