<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $fillable = [
        'name',
        'type',
        'minimum_quantity',
        'maximum_quantity'
    ];

    public function productsCompaniesRelation()
    {
        return $this->belongsToMany(Company::class,'products_companies','products_id','company_id');
    }

    public function setMinimumQuantityAttribute($value)
    {
        $this->attributes['minimum_quantity'] = floatval(converStringToDouble($value));
    }

    public function setMaximumQuantityAttribute($value)
    {
        $this->attributes['maximum_quantity'] = floatval(converStringToDouble($value));
    }
}
