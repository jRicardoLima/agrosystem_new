<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Occupation extends Model
{
    protected $fillable = [
        'name'
    ];

    public function UserRelation()
    {
        return $this->hasOne(User::class,'occupation_id','id');
    }

    public function employeeRelation()
    {
        return $this->hasOne(Employee::class,'occupation_id','id');
    }

}
