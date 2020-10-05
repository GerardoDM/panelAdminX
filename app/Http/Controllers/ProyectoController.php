<?php

namespace App\Http\Controllers;

use App\Models\Proyecto;
use Illuminate\Http\Request;

class ProyectoController extends Controller
{
    public function index(){

        $proyectos = Proyecto::all();
        return $proyectos;
        
    }

    public function create(Request $request){

        $proyecto = new Proyecto();

        $proyecto->nombre = $request->input('nombre');
        $proyecto->fecha = $request->input('fecha');
        $proyecto->descripcion = $request->input('descripcion');
        $proyecto->nomenclatura = $request->input('nomenclatura');
    
        $proyecto->save();
        
    }

    public function delete($clave){

        $proyecto = Proyecto::find($clave);
        $proyecto->delete();

    }

    public function update(Request $request, $clave){

        $proyecto = Proyecto::find($clave);
        $proyecto->nombre = $request->input('nombre');
        $proyecto->fecha = $request->input('fecha');
        $proyecto->descripcion = $request->input('descripcion');
        $proyecto->nomenclatura = $request->input('nomenclatura');

        $proyecto->save();
        return $proyecto;

    }
}
