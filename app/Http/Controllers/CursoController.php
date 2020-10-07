<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Curso;

class CursoController extends Controller
{

    public function index(){

        $cursos = Curso::all();
        return $cursos;
        
    }

    public function create(Request $request){

        $curso = new Curso();

        $curso->nombre = $request->input('nombre');
        $curso->nom_sep = $request->input('nom_sep');
        $curso->btotales = $request->input('btotales');
        $curso->blib = $request->input('blib');
        $curso->autor = $request->input('autor');
        $curso->cve_usuario = $request->input('cve_usuario');
        $curso->ruta_descarga = $request->input('ruta_descarga');
        $curso->ruta_ver = $request->input('ruta_ver');
        $curso->status = $request->input('status');
        $curso->ruta_operacion = $request->input('ruta_operacion');
        $curso->cve_status = $request->input('cve_status');
        
        $curso->save();
        
    }

    public function delete($clave){

        $curso = curso::find($clave);
        $curso->delete();

    }

    public function update(Request $request, $clave){

        $curso = Curso::find($clave);

        $curso->nombre = $request->input('nombre');
        $curso->nom_sep = $request->input('nom_sep');
        $curso->btotales = $request->input('btotales');
        $curso->blib = $request->input('blib');
        $curso->autor = $request->input('autor');
        $curso->cve_usuario = $request->input('cve_usuario');
        $curso->ruta_descarga = $request->input('ruta_descarga');
        $curso->ruta_ver = $request->input('ruta_ver');
        $curso->status = $request->input('status');
        $curso->ruta_operacion = $request->input('ruta_operacion');
        $curso->cve_status = $request->input('cve_status');
            
        $curso->save();
        return $curso;

    }
}


