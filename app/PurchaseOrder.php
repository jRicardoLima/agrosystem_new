<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
    protected $table = "purchase_orders";

    protected $fillable = [
      'request_number',
      'justification',
      'user_id',
      'employee_id',
      'requesting_user'
    ];

    public function userRelation()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function employeeRelation()
    {
        return $this->belongsTo(Employee::class,'employee_id','id');
    }

    public function employeeRequestingRelation()
    {
        return $this->belongsTo(Employee::class,'requesting_user','id');
    }

    public function accountRelation()
    {
        return $this->hasMany(Account::class,'request_number_id','id');
    }

    public function scopeRequestNumber($query,$requestNumber)
    {
        return $query->where('request_number','=',$requestNumber);
    }
}
