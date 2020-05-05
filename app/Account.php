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
    ];

    public function companyRelation()
    {
        return $this->belongsTo(Company::class,'company_id','id');
    }

    public function employeeRelation()
    {
        return $this->belongsTo(Employee::class,'employee_id','id');
    }
}
