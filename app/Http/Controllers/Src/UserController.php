<?php

namespace App\Http\Controllers\Src;

use App\Http\Controllers\Controller;
use App\Http\Requests\Src\UserRequest;
use App\Menu;
use App\Occupation;
use App\Unity;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $occupation = Occupation::all();
        $unity = Unity::all();
        return view('admin.sistema.gestao_usuario.cadastrar')->with([
            'occupations' => $occupation,
            'unities' => $unity
        ]);
    }

    public function search()
    {
        $users = User::all();
        return view('admin.sistema.gestao_usuario.search')->with(['users' => $users]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $user = new User();
        $userSearchNameUser = User::where('name_user', '=',$request->name_user)->get()->count();
        if($userSearchNameUser == 0){
            $user->name = $request->name;
            $user->name_user = $request->name_user;
            $user->document_primary = $request->document_primary;
            $user->password = $request->password;
            $user->occupation_id = $request->occupation_id;
            $user->unity_id = $request->unity_id;

            if($request->hasFile('avatar')){
                $document = clearVars(['.','-',' '],$request->document_primary);
                $user->avatar = $request->file('avatar')->storeAs('avatar',$document.$request->file('avatar')->getClientOriginalName());
            }


            $user->save();

            Log::channel('systemLog')->info('Usuario:'.Auth::user()->name.' CPF:'.Auth::user()->document_primary." Cadastrou:".$user->name_user);
            session()->flash('messageInfo','Success@Usuário cadastrado com sucesso');
            return redirect()->route('source.users.create');
        } else {
            session()->flash('messageInfo','Warning@Já existe este nome de usuário');
            return redirect()->route('source.users.create');
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $occupations = Occupation::all();
        $unities = Unity::all();
        $menus = new Menu();
        return view('admin.sistema.gestao_usuario.edit')->with([
            'user' => $user,
            'occupations' => $occupations,
            'unities' => $unities,
            'menus' => $menus
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'name' => 'required|min:3',
            'name_user' => 'required|min:3',
            'document_primary' => 'required|min:11|max:14',
            'occupation_id' => 'notIn:0',
            'unity_id' => 'required|notIn:0',
            'avatar' => 'mimes:jpg,png,jpeg,gif'
        ];
        $request->validate($rules);

        $user = User::find($id);
        $userSearchNameUser = User::where('name_user', '=',$request->name_user)->get()->count();
        if($userSearchNameUser == 0 || $user->name_user == $request->name_user){
             $user->name = $request->name;
             $user->name_user = $request->name_user;
             $user->document_primary = $request->document_primary;
             $user->occupation_id = $request->occupation_id;
             $user->unity_id = $request->unity_id;

            if($request->hasFile('avatar')){
                if(Storage::exists($request->document_user.$request->file('avatar')->getClientOriginalName())){
                    Storage::delete('avatar/'.$request->document_user);
                    $document = clearVars(['.','-',' '],$request->document_primary);
                    $user->avatar = $request->file('avatar')->storeAs('avatar',$document.$request->file('avatar')->getClientOriginalName());
                }else{
                    $document = clearVars(['.','-',' '],$request->document_primary);
                    $user->avatar = $request->file('avatar')->storeAs('avatar',$document.$request->file('avatar')->getClientOriginalName());
                }
            }
            $user->save();
            Log::channel('systemLog')->info('Usuario:'.Auth::user()->name.' CPF:'.Auth::user()->document_primary." Atualizou:".$user->name_user);
            session()->flash('messageInfo','Success@Usuário atualizado com sucesso');
            return redirect()->route('source.users.edit',['user' => $user->id]);
        } else {
            session()->flash('messageInfo','Warning@Não foi possivel atualizar o usuário');
            return back()->withInput();
        }

    }

    public function updatePassword(Request $request,$id)
    {
        $rules = [
            'password' => 'required',
            'name_user_edit' => 'required'
        ];

        $request->validate($rules);

        $user = User::find($id);
        $userNameVerify = User::where('name_user', '=',$request->name_user_edit)->get()->count();

        if($userNameVerify == 0 || $user->name_user == $request->name_user_edit){

            $user->name_user = $request->name_user_edit;
            $user->password = $request->password;

            $user->save();
            Log::channel('systemLog')->info('Usuario:'.Auth::user()->name.' CPF:'.Auth::user()->document_primary." Atualizou:".$user->name_user);
            session()->flash('messageInfo','Success@Usuário Atualizado com sucesso');
            return redirect()->route('source.users.edit',['user' => $user->id]);
        } else{
            session()->flash('messageInfo','Warning@Já existe este nome de usuário');
            return back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
   {

       User::where('id','=',$id)->first()->delete();
   }

    public function delete($id)
    {
        User::where('id','=',$id)->first()->delete();
        session()->flash('messageInfo','Success@Usuario excluido com sucesso');
        return back()->withInput();

    }
}
