<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{

    protected $fillable = [
        'name_module',
        'name_sub_module',
        'user_id',
        'authorization'
    ];
    public $timestamps = false;

    public function userRelation()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function editCheckboxMenu(int $id,string $name_module ,string $name_sub_module)
    {
        $userMenus = $this->where('user_id','=',$id)->get();

        $value = null;
            if($userMenus != null || !empty($id) || !empty($name_sub_module) || !empty($name_module)){
                foreach ($userMenus as $userMenu) {

                    if($name_module == $userMenu->name_module && $name_sub_module == $userMenu->name_sub_module && $userMenu->authorization == 1){

                        $value = true;
                        break;
                    }else {
                        $value = false;
                    }
                }
                return $value;
            }else{
                echo '';
            }
    }
    public function updateAccess(string $name_sub_module_database,string $name_sub_module_request)
    {
        if($name_sub_module_database != $name_sub_module_request){
            return 'O usuario nao tem permissão no módulo '.$name_sub_module_request.'<br>';
        }
    }


}
