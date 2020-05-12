<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unity extends Model
{
    protected $fillable = [
      'name',
      'place'
    ];

    public function userRelation()
    {
        return $this->hasOne(User::class,'unity_id','id');
    }

    public function employeeRelation()
    {
        return $this->hasOne(Employee::class,'unity_id','id');
    }

    public function productOutputRelation()
    {
        return $this->hasMany(ProductOutput::class,'unity_id','id');
    }
}
