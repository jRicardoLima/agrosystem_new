<?php

namespace App\Http\Controllers\Src;

use App\Http\Controllers\Controller;
use App\User;
use App\Utils\MessageAjax;
use App\Utils\NetworkManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{

    public function index()
    {
        if(Auth::check() === true){
            return redirect()->route('source.home');
        }
        return view('admin.index');
    }

    public function login(Request $request)
    {
        $json = [];
        $message = new MessageAjax();

        if(empty($request->user) || empty($request->password)){
            $message->setMessage('Ooops Usuario e senha são campos obrigatórios');
            $message->setType('warning');
            $json['message'] = $message->render();
            return response()->json($json);
        }

        $credentials = [
            'name_user' => $request->user,
            'password' => $request->password
        ];

        if(!Auth::attempt($credentials)){
            $message->setMessage('Ooops Usuario ou senha incorreto');
            $message->setType('danger');
            $json['message'] = $message->render();

            return response()->json($json);
        }

        $networkManager = new NetworkManager($request->getClientIp());
        $user = new User();
        $networkManager->saveIpDatabase($user,Auth::user()->id);
        Log::channel('systemLog')->info('Usuario:'.Auth::user()->name." CPF:".Auth::user()->document_primary." Logou no sistema");
        $json['redirect'] = route('source.home');

        return response()->json($json);

    }

    public function home()
    {

        return view('admin.dashboard');
    }

    public function logout()
    {
        Log::channel('systemLog')->info('Usuario:'.Auth::user()->name." CPF:".Auth::user()->document_primary." Saiu do sistema");
        Auth::logout();
        return redirect()->route('source.source.index');
    }


}
