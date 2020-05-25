<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $table = 'accounts';

    protected $fillable = [
      'company_id',
      'type_payment',
      'employee_id',
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

    public function installmentsRelation()
    {
        return $this->hasMany(Installment::class,'account_id','id');
    }

}
