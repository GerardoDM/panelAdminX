<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bloque;

class BloqueController extends Controller
{

    public function index(){

        $bloques = Bloque::all();
        return $bloques;
        
    }

    public function create(Request $request){

        $bloque = new Bloque();

        $bloque->nombre = $request->input('nombre');
        $bloque->cve_curso = $request->input('cve_curso');
        $bloque->cve_status = $request->input('cve_status');
        $bloque->version = $request->input('version');
        $bloque->ruta_portal = $request->input('ruta_portal');
      
        
        $bloque->save();
        
    }

    public function delete($clave){

        $bloque = Bloque::find($clave);
        $bloque->delete();

    }

    public function update(Request $request, $clave){

        $bloque = Bloque::find($clave);

        $bloque->nombre = $request->input('nombre');
        $bloque->cve_curso = $request->input('cve_curso');
        $bloque->cve_status = $request->input('cve_status');
        $bloque->version = $request->input('version');
        $bloque->ruta_portal = $request->input('ruta_portal');
      
            
        $bloque->save();
        return $bloque;

    }
}




