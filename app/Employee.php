<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use SoftDeletes;
    protected $table = 'employees';

    protected $fillable = [
        'name',
        'document_primary',
        'document_secondary',
        'document_secondary_complement',
        'married',
        'children',
        'number_of_children',
        'date_birth',
        'zipcode',
        'state',
        'city',
        'street',
        'neighborhood',
        'telphone',
        'celphone',
        'email',
        'contract_date',
        'salary',
        'occupation_id',
        'unity_id',
        'bank',
        'account',
        'agency'
    ];

    public function AccountRelation()
    {
        return $this->hasMany(Account::class,'employee_id','id');
    }

    public function occupationRelation()
    {
        return $this->belongsTo(Occupation::class,'occupation_id','id');
    }
    public function unityRelation()
    {
        return $this->belongsTo(Unity::class,'unity_id','id');
    }


    public function setDocumentPrimaryAttribute($value)
    {
        $this->attributes['document_primary'] = clearVars(['.','-'],$value);
    }

    public function getDocumentPrimaryAttribute($value)
    {
        return convertCPF($value);
    }
    public function setDocumentSecondaryAttribute($value)
    {
        $this->attributes['document_secondary'] = clearVars(['.','-'],$value);
    }

    public function setMarriedAttribute($value)
    {
        $this->attributes['married'] = ($value == '1' ? 1 : 0);
    }

    public function setChildrenAttribute($value)
    {
        $this->attributes['children'] = ($value == '1' ? 1 : 0);
    }

    public function setNumberOfChildrenAttribute($value)
    {
        $this->attributes['number_of_children'] = ($value != "" || $value != 0 ? (integer) $value : 0);
    }

    public function setDateBirthAttribute($value)
    {
        $this->attributes['date_birth'] = convertDateToDatabase($value);
    }

    public function getDateBirthAttribute($value)
    {
        $date = new \DateTime($value);
        return $date->format('d/m/Y');
    }

    public function setZipCodeAttribute($value)
    {
        $this->attributes['zipcode'] = clearVars(['-','.','@',':'],$value);
    }

    public function setTelphoneAttribute($value)
    {
        $this->attributes['telphone'] = clearVars(['-','.','@',':'],$value);
    }

    public function setCelphoneAttribute($value)
    {
        $this->attributes['celphone'] = clearVars(['-','.','@',':'],$value);
    }

    public function setContractDateAttribute($value)
    {
        $this->attributes['contract_date'] = convertDateToDatabase($value);
    }

    public function getContractDateAttribute($value)
    {
        $date = new \DateTime($value);

        return $date->format('d/m/Y');
    }

    public function getDepartureDateAttribute($value)
    {
        $date = new \DateTime($value);
        return $date->format('d/m/Y');
    }

    public function setSalaryAttribute($value)
    {
        $this->attributes['salary'] = floatval(converStringToDouble($value));
    }

    public function getSalaryAttribute($value)
    {
        return convertFloatBR($value);
    }

}
