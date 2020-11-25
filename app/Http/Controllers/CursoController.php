<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Curso;
use \Validator;


class CursoController extends Controller
{

    public function view(){

        return view('pages.cursos');
        
    }

    public function viewDetail(){
        return view('pages.cursoDetalle');
    }

    public function index(){

        $cursos = Curso::all();
        return $cursos;
        
    }

    public function create(Request $request){

        $curso = Validator::make($request->all(), [
            'nombre' => 'required',
            'nom_sep' => 'required',
            'btotales' => 'required',
            'blib' => 'required',
            'autor' => 'required',
            'cve_usuario' => 'required',
            'ruta_descarga' => 'required',
            'ruta_ver' => 'required',
            'status' => 'required',
            'ruta_operacion' => 'required',
            'cve_status' => 'required',
            
         ]);

         if($curso->fails()){
            return response()->json($curso->messages(), 400);
         }

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

        return response()->json(['Curso' => $curso], 201);
        
    }

    public function delete($clave){

        $curso = curso::find($clave);
        $curso->delete();

    }

    public function update(Request $request, $clave){

        $curso = Validator::make($request->all(), [
            'nombre' => 'required',
            'nom_sep' => 'required',
            'btotales' => 'required',
            'blib' => 'required',
            'autor' => 'required',
            'cve_usuario' => 'required',
            'ruta_descarga' => 'required',
            'ruta_ver' => 'required',
            'status' => 'required',
            'ruta_operacion' => 'required',
            'cve_status' => 'required',
            
         ]);

         if($curso->fails()){
            return response()->json($curso->messages(), 400);
         }

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
        return response()->json(['Curso' => $curso], 201);

    }

    public function search(){

        if ($search = \Request::get('q')) {
            $cursos = Curso::where(function($query) use ($search){
                $query->where('nombre','LIKE',"%$search%");
                        
            })->get();
        }else{

            return response()->json($cursos->messages(), 400);
            
        }

        return $cursos;

    }

    public function show($clave){

        $curso = Curso::find($clave);
        return $curso;

    }
}


