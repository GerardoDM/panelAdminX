<?php

namespace App\Http\Controllers\Auth\Login;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Auth\LoginController as DefaultLoginController;
use App\Usuario;
use Illuminate\Support\Facades\Log;

class UsuariosLoginController extends DefaultLoginController
{

    public $user;

    //protected $redirectTo = '/usuario/home';

    public function __construct()
    {

        Auth::shouldUse('usuario');

        $this->middleware('guest:usuario')->except('logout');
    }
    public function showLoginForm()
    {
        return view('auth.login.usuario');
    }
    public function username()
    {
        return 'mail';
    }
    protected function guard()
    {

        //Auth::shouldUse('');
        return Auth::guard('usuario');
    }


    protected function validateLogin(Request $request){
        $this->validate($request, [
            $this->username() => 'required',
            'pass' => 'required',
        ]);
    }

    protected function attemptLogin(Request $request)
    {
          return $this->guard()->attempt($this->credentials($request));
    }

    protected function credentials(Request $request)
    
    {
        return $request->only($this->username(), 'pass');
    }

    public function login(Request $request){

        // CAN ONLY DO AUTH::ATTEMPT WITH A HASHED PASSWORD 

        // if (Auth::attempt(['mail' => $request->mail,'password' => $request->pass], false)){
    
        //      return redirect()->intended(route('usuario.home'));
        // }
    
        // return $this->sendFailedLoginResponse($request);

        //  METHOD WITHOUT ATTEMPT , UNHASHED PASSWORD, AUTH::LOGIN RETURNS NULL


           $user = Usuario::where([
              'mail' => $request->mail, 
               'pass' => $request->pass
               ])->first();
            
            if($user->pass === $request->pass)

            {
            
                auth()->loginUsingId($user->clave);
               // Auth::login($user);
               dd(auth()->loginUsingId($user->clave));
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
