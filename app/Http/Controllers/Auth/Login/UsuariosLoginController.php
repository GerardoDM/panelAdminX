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

        Auth::shouldUse('custom');
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
          ($this->guard()->attempt(
            $this->credentials($request)
        ));
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

        //  METHOD WITHOUT ATTEMPT , UNHASHED PASSWORD

        //  $user = Usuario::where([
        //     'mail' => $request->mail, 
        //      'pass' => $request->pass
        //  ])->first();

        $this->validateLogin($request);

        if ($this->attemptLogin($request)){
           
            //dd($request);
            return redirect('/usuario/home');

        }

        dd($request);

        //dd($this->credentials($request));

        //     //Auth::login($user);
        //     //dd($user);
        
    }
    
    
}
