<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Installment extends Model
{
    protected $table = 'installments';

    protected $fillable = [
        'number_installments',
        'value',
        'due_date',
        'account_id',
        'status'
    ];

    public function accountRelation()
    {
        return $this->belongsTo(Account::class,'account_id','id');
    }

    public function setDueDate($value)
    {
        $this->attributes['due_date'] = convertDateToDatabase($value);
    }

    public function setValueAttribute($value)
    {
        $this->attributes['value'] = floatval(converStringToDouble($value));
    }

    public function setStatusAttribute($value)
    {
        $this->attributes['status'] = ($value == '0' ? 0 : 1);
    }

    public function searchNullValues(array $values)
    {
        $result = true;
        foreach ($values as $value){
            if($value == null){
                $result = false;
            }
        }
        return $result;
    }
}
