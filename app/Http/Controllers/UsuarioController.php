<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Usuario;



class UsuarioController extends Controller
{
    public function index(){

        $usuarios = Usuario::all();
        return $usuarios;
        
    }

    public function create(Request $request){

        $usuario = new Usuario();

        $usuario->nombre = $request->input('nombre');
        $usuario->apepat = $request->input('apepat');
        $usuario->apemat = $request->input('apemat');
        $usuario->mail = $request->input('mail');
        $usuario->nickname = $request->input('nickname');
        $usuario->pass = $request->input('pass');
        $usuario->status = 1;
        $usuario->cve_tipousuario = 3;

        $usuario->save();
        
    }

    public function delete($clave){

        $usuario = Usuario::find($clave);
        $usuario->delete();


    }

    public function update(Request $request, $clave){

        $usuario = Usuario::find($clave);
        $usuario->nombre = $request->input('nombre');
        $usuario->apepat = $request->input('apepat');
        $usuario->apemat = $request->input('apemat');
        $usuario->mail = $request->input('mail');
        $usuario->nickname = $request->input('nickname');
        $usuario->pass = $request->input('pass');
        $usuario->status = 1;
        $usuario->cve_tipousuario = 3;

        $usuario->save();
        return $usuario;


    }
}
