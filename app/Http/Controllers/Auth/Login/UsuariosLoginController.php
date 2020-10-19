<?php

namespace App\Http\Controllers\Auth\Login;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Auth\LoginController as DefaultLoginController;
use App\Usuario;
use App\User;
use Illuminate\Support\Facades\Log;

class UsuariosLoginController extends DefaultLoginController
{

    public $user;

    
    public function showLoginForm()
    {
        return view('auth.login.usuario');
    }

    
    protected function validateLogin(Request $request){
        $this->validate($request, [
            $this->username() => 'required',
            'pass' => 'required',
        ]);
    }


    public function logout(Request $request) {
        // Laravel default implementation
        $this->guard()->logout();
        $request->session()->invalidate();
        
        // Added this
        $request->session()->regenerateToken();
        return $request->session()->token();
    }


    public function login(Request $request){


        $usuario = User::where([
            'mail' => $request->mail, 
             'pass' => $request->pass
             ])->first();


             if ($usuario){

                

            auth()->loginUsingId($usuario->clave);
        

                return redirect()->route('/');

             }

             else  {
                 return redirect()->back();
             }


    }

    public function loginDos(Request $request){


        // CAN ONLY DO AUTH::ATTEMPT WITH A HASHED PASSWORD 

        //  METHOD WITHOUT ATTEMPT , UNHASHED PASSWORD, AUTH::LOGIN RETURNS NULL


           $usuario = Usuario::where([
              'mail' => $request->mail, 
               'pass' => $request->pass
               ])->first();
            
            if($usuario)

            {
                return $usuario;
            
                auth()->loginUsingId($usuario->clave);
               
                return redirect('usuario/home');
                        
            }

           //   $request = $user; IS WRONG BECAUSE VALIDATELOGIN() ONLY ACCEPTS REQUEST TYPE OBJECT, NOT USER
           // ATTEMPTLOGIN() RETURNS FALSE

    
        
    }

        
}
