<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'name_user',
        'document_primary',
        'password',
        'occupation_id',
        'unity_id',
        'avatar',
        'ip'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function unityRelation()
    {
        return $this->belongsTo(Unity::class,'unity_id','id');
    }

    public function occupationRelation()
    {
        return $this->belongsTo(Occupation::class,'occupation_id','id');
    }

    public function menusRelation()
    {
        return $this->hasMany(Menu::class,'user_id','id');
    }

    public function scopeAvatar($query,$id)
    {
        return $query->select('avatar')->where('id','=',$id);
    }
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    public function setDocumentPrimaryAttribute($value)
    {
        $this->attributes['document_primary'] = clearVars(['.','/','-'],$value);
    }
}
