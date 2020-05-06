<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductCompanies extends Model
{
    protected $table = "products_companies";

    protected $fillable = [
      'company_id',
      'products_id',
    ];
}
