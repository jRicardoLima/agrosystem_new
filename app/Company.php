<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use SoftDeletes;
    protected $table = 'companies';

    protected $fillable = [
        'fantasy_name',
        'company_name',
        'physic_person',
        'document_company_identification',
        'document_primary',
        'zipcode',
        'state',
        'city',
        'street',
        'neighborhood',
        'contact_one',
        'contact_two',
        'email',
    ];

    public function accountRelation()
    {
        return $this->hasMany(Account::class,'company_id','id');
    }

    public function companiesProductsRelation()
    {
        return $this->belongsToMany(Product::class, 'products_companies', 'company_id', 'products_id')->withPivot(['products_id', 'company_id']);
    }

    public function fixedAccountRelation()
    {
        return $this->hasMany(FixedAccount::class,'companies_id','id');
    }

    public function exepenseFuelRelation()
    {
        return $this->hasMany(ExpenseFuel::class,'company_id','id');
    }

    public function setPhysicPersonAttribute($value)
    {
        return $this->attributes['physic_person'] = ($value == "1" ? 1 : 0);
    }
    public function setDocumentCompanyIdentificationAttribute($value)
    {
        return $this->attributes['document_company_identification'] = clearVars(['.','-','_','/'],$value);
    }

    public function getDocumentCompanyIdentificationAttribute($value)
    {
        return convertCNPJ($value);
    }
    public function setDocumentPrimaryAttribute($value)
    {
        return $this->attributes['document_primary'] = clearVars(['.','-','_','/'],$value);
    }
    public function getDocumentPrimaryAttribute($value)
    {
        return convertCPF($value);
    }
    public function setZipcodeAttribute($value)
    {
        return $this->attributes['zipcode'] = clearVars(['.','-','/'],$value);
    }
}
