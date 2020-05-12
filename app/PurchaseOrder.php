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
      'employee_id'
    ];
}
