<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $table = 'accounts';

    protected $fillable = [
      'company_id',
      'type_payment',
      'installments',
      'value',
      'due_date',
      'employee_id',
      'status',
      'access_key_id',
      'request_number_id'
    ];

    public function companyRelation()
    {
        return $this->belongsTo(Company::class,'company_id','id');
    }

    public function employeeRelation()
    {
        return $this->belongsTo(Employee::class,'employee_id','id');
    }

    public function invoiceRelation()
    {
        return $this->belongsTo(Invoice::class,'access_key_id','id');
    }

    public function purchaseOrder()
    {
        return $this->belongsTo(PurchaseOrder::class,'request_number_id','id');
    }

    public function setDueDateAttribute($value)
    {
        $this->attributes['due_date'] = convertDateToDatabase($value);
    }

    public function setStatusAttribute($value)
    {
        $this->attributes['status'] = ($value == '0' ? 0 : 1);
    }

    public function setValueAttribute($value)
    {
        $this->attributes['value'] = floatval(converStringToDouble($value));
    }
}
