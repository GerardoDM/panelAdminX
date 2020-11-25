<?php

namespace App\Http\Controllers;

use App\Models\Proyecto;

use \Validator;

use Illuminate\Http\Request;

class ProyectoController extends Controller
{

    public function view(){

        return view('pages.proyectos');
    
    }

    public function viewDetail(){
        return view('pages.proyectoDetalle');
    }


    public function index(){

        $proyectos = Proyecto::all();
        return $proyectos;
        
    }

    public function create(Request $request){

       


        $proyecto = Validator::make($request->all(), [
            'clave' => 'required',
            'nombre' => 'required',
            'fecha' => 'required',
            'descripcion' => 'required',
            'nomenclatura' => 'required',
         ]);


         if($proyecto->fails()){
            return response()->json($proyecto->messages(), 400);
         }
        
        $proyecto = new Proyecto();

        $proyecto->clave = $request->input('clave');

        $proyecto->nombre = $request->input('nombre');
        $proyecto->fecha = $request->input('fecha');
        $proyecto->descripcion = $request->input('descripcion');
        $proyecto->nomenclatura = $request->input('nomenclatura');

        $proyecto->save();

        return response()->json(['Proyecto' => $proyecto], 201);
        
        
    }

    public function delete($clave){

        $proyecto = Proyecto::find($clave);
        $proyecto->delete();

    }

    public function update(Request $request, $clave){

        $proyecto = Validator::make($request->all(), [
            'clave' => 'required',
            'nombre' => 'required',
            'fecha' => 'required',
            'descripcion' => 'required',
            'nomenclatura' => 'required',
         ]);


         if($proyecto->fails()){
            return response()->json($proyecto->messages(), 400);
         }

        $proyecto = Proyecto::find($clave);
        $proyecto->nombre = $request->input('nombre');
        $proyecto->fecha = $request->input('fecha');
        $proyecto->descripcion = $request->input('descripcion');
        $proyecto->nomenclatura = $request->input('nomenclatura');

        $proyecto->save();
        return response()->json(['Proyecto' => $proyecto], 201);

    }

    public function show($clave){

        $proyecto = Proyecto::find($clave);
        return $proyecto;

    }
}
