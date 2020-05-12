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

    public function accountRelation()
    {
        return $this->hasMany(Account::class,'access_key_id','id');
    }

    public function scopeAccessKey($query,$key)
    {
        return $query->where('access_key','=',$key);
    }

    public function getCreatedAtAttribute($value)
    {
        return $this->attributes['created_at'] = convertDateTimeToBr($value);
    }

}
