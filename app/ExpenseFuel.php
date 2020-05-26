<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExpenseFuel extends Model
{
    use SoftDeletes;

    protected $table = 'expenses_fuel';

    protected $fillable = [
        'name_product',
        'access_key',
        'quantity',
        'type',
        'value',
        'due_date',
        'status',
        'company_id',
        'purchase_id',
        'danfe_path'
    ];

    public function companyRelation()
    {
        return $this->belongsTo(Company::class,'company_id','id');
    }

    public function purchaseRelation()
    {
        return $this->belongsTo(PurchaseOrder::class,'purchase_id','id');
    }

    public function setAccessKeyAttribute($value)
    {
        $this->attributes['access_key'] = cleanSpaceString($value);
    }

    public function setQuantityAttribute($value)
    {
        $this->attributes['quantity'] = floatval(converStringToDouble($value));
    }

    public function setValueAttribute($value)
    {
        $this->attributes['value'] = floatval(converStringToDouble($value));
    }
    public function setDueDateAttribute($value)
    {
        $this->attributes['due_date'] = convertDateToDatabase($value);
    }

    public function setStatusAttribute($value)
    {
        $this->attributes['status'] = ($value == '0' ? 0 : 1);
    }

}
