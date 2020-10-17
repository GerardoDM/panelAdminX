<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bloque;
use \Validator;


class BloqueController extends Controller
{

    public function view(){

        return view('pages.bloques');
        
    }

    public function index(){

        $bloques = Bloque::all();
        return $bloques;
        
    }

    public function create(Request $request){

        $bloque = Validator::make($request->all(), [
            'nombre' => 'required',
            'cve_curso' => 'required',
            'cve_status' => 'required',
            'version' => 'required',
            'ruta_portal' => 'required',
            
         ]);

         if($bloque->fails()){
            return response()->json($bloque->messages(), 400);
         }

        $bloque = new Bloque();

        $bloque->nombre = $request->input('nombre');
        $bloque->cve_curso = $request->input('cve_curso');
        $bloque->cve_status = $request->input('cve_status');
        $bloque->version = $request->input('version');
        $bloque->ruta_portal = $request->input('ruta_portal');
      
        
        $bloque->save();

        return response()->json(['Bloque' => $bloque], 201);

        
    }

    public function delete($clave){

        $bloque = Bloque::find($clave);
        $bloque->delete();

    }

    public function update(Request $request, $clave){

        $bloque = Validator::make($request->all(), [
            'nombre' => 'required',
            'cve_curso' => 'required',
            'cve_status' => 'required',
            'version' => 'required',
            'ruta_portal' => 'required',
            
         ]);

         if($bloque->fails()){
            return response()->json($bloque->messages(), 400);
         }

        $bloque = Bloque::find($clave);

        $bloque->nombre = $request->input('nombre');
        $bloque->cve_curso = $request->input('cve_curso');
        $bloque->cve_status = $request->input('cve_status');
        $bloque->version = $request->input('version');
        $bloque->ruta_portal = $request->input('ruta_portal');
      
            
        $bloque->save();
        return response()->json(['Bloque' => $bloque], 201);

    }
}




