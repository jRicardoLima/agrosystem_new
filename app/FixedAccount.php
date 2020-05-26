<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FixedAccount extends Model
{
    protected $table = 'fixed_expenses';

    protected $fillable = [
        'name_fixed_product',
        'companies_id',
        'type',
        'value',
        'due_date',
        'status'
    ];

    public function CompanyRelation()
    {
        return $this->belongsTo(Company::class,'companies_id','id');
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
