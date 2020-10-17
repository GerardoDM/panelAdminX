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

    //protected $redirectTo = '/usuario/home';

    // public function __construct()
    // {

    //     //Auth::shouldUse('usuario');

    //     $this->middleware('guest:usuario')->except('logout');
    // }
    public function showLoginForm()
    {
        return view('auth.login.usuario');
    }

    // public function username()
    // {
    //     return 'mail';
    // }


    // protected function guard()
    // {

    //     //Auth::shouldUse('');
    //    // return Auth::guard('usuario');
    // }


    protected function validateLogin(Request $request){
        $this->validate($request, [
            $this->username() => 'required',
            'pass' => 'required',
        ]);
    }

    // protected function attemptLogin(Request $request)
    // {
    //       return $this->guard()->attempt($this->credentials($request));
    // }


    // protected function credentials(Request $request)
    
    // {
    //     return $request->only($this->username(), 'pass');
    // }

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
              //return Auth::guard('web')->loginUsingId($usuario->clave);

                // Get the currently authenticated user...
               // return $user = Auth::user();

                return redirect()->route('/');

             }

             else  {
                 return redirect()->back();
             }


    }

    public function loginDos(Request $request){

        // return $request->all();

        // CAN ONLY DO AUTH::ATTEMPT WITH A HASHED PASSWORD 

        // if (Auth::attempt(['mail' => $request->mail,'password' => $request->pass], false)){
    
        //      return redirect()->intended(route('usuario.home'));
        // }
    
        // return $this->sendFailedLoginResponse($request);

        //  METHOD WITHOUT ATTEMPT , UNHASHED PASSWORD, AUTH::LOGIN RETURNS NULL


           $usuario = Usuario::where([
              'mail' => $request->mail, 
               'pass' => $request->pass
               ])->first();
            
            if($usuario)

            {
                return $usuario;
            
                auth()->loginUsingId($usuario->clave);
               // Auth::login($user);
               //dd(auth()->loginUsingId($usuario->clave));


               //dd($this->credentials($request));
              // dd($this->attemptLogin($request));
               //dd($request);
                return redirect('usuario/home');
                        
            }

           //   $request = $user; IS WRONG BECAUSE VALIDATELOGIN() ONLY ACCEPTS REQUEST TYPE OBJECT, NOT USER
           // ATTEMPTLOGIN() RETURNS FALSE

        // $this->validateLogin($request);

        // if ($this->attemptLogin($request)){
           
        //     dd('ooooo');
        //     return redirect('/usuario/home');

        // }

        // dd($this->attemptLogin($request));
        
    }

        
}
