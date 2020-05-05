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
        'street',
        'neighborhood',
        'contact_one',
        'contact_two',
        'email',
    ];
}
