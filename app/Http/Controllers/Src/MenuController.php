<?php

namespace App\Http\Controllers\Src;

use App\Http\Controllers\Controller;
use App\Menu;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class MenuController extends Controller
{
    public function permissions()
    {
        return view('admin.sistema.gestao_usuario.permissions');
    }

    public function storePermissions(Request $request)
    {
        $user = User::where('name_user','=',$request->name_user)->first(['id']);

        $request->validate([
            'name_user' => 'required'
        ]);

       if($user != null){
           $results = array_filter($request->all(),function($value,$key){
               return $key != "_token" && $key != "" && $key != "name_user" && $value != "";
           },ARRAY_FILTER_USE_BOTH);

           foreach ($results as $key => $value){
                DB::table('menus')->insert([
                    'name_module' => strstr($key,'@',true),
                    'name_sub_module' => clearVars(['@','-'],strstr($key,'@')),
                    'user_id' => $user->id,
                    'authorization' => 1
                ]);

           }
           Log::channel('systemLog')->info('Usuario:'.Auth::user()->name.' CPF:'.Auth::user()->document_primary." Liberou permissões para:".$request->name_user);
           session()->flash('messageInfo','Success@Permissões concedidas ao usuario');
           return redirect()->route('source.menus.permissions');
       } else {

           session()->flash('messageInfo','Warning@Nome de usuário não encontrado');
           return redirect()->route('source.menus.permissions');
       }

    }

    public function updatePermission(Request $request,$id)
    {

        $menusComparate = \App\Menu::where('user_id','=',$id)
                                   ->where('authorization','=',1)
                                   ->get();

        if($menusComparate->count() > 0){
            $results = array_filter($request->all(),function($value,$key){
               return $key != "_token" && $key != "" && $value !="" && $key !="_method";
            },ARRAY_FILTER_USE_BOTH);

            $count = 0;
            foreach ($results as $key => $value){
                    if($value == 'inativo'){

                       $rowsAffected = DB::table('menus')->where([
                            ['user_id','=',$id],
                            ['name_module','=',strstr($key,'@',true)],
                            ['name_sub_module','=',clearVars(['@','-'],strstr($key,'@'))]
                        ])->update(['authorization' => 0]);

                       if($rowsAffected == 1 ){
                           $count = $count + 1;
                       }
                    }elseif($value == "ativo") {

                   $rowsAffected = DB::table('menus')->where([
                          ['user_id','=',$id],
                          ['name_module','=',strstr($key,'@',true)],
                         ['name_sub_module','=',clearVars(['@','-'],strstr($key,'@'))]
                          ])->update(['authorization' => 1]);

                   if($rowsAffected == 1){
                       $count = $count + 1;
                   }

                    }
            }
            if($count == 0){
                session()->flash('messageInfo','Warning@Usuario não possui acesso a este módulo');
                return back()->withInput();
            }
            session()->flash('messageInfo','Success@As permissões foram alteradas');
            return back()->withInput();
        } else {
            session()->flash('messageInfo','Warning@Usuario não possui menus cadastrados');
            return back()->withInput();
        }

    }

}
