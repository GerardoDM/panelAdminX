<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function index(){

        $productos = Producto::all();
        return $productos;
        
    }

    public function create(Request $request){

        $producto = Validator::make($request->all(), [
            'clave' => 'required',
            'nombre' => 'required',
            'edicion' => 'required',
            'nomenclatura' => 'required',
         ]);


         if($producto->fails()){
            return response()->json($producto->messages(), 400);
         }

        $producto = new Producto();

        $producto->clave = $request->input('clave');
        $producto->nombre = $request->input('nombre');
        $producto->edicion = $request->input('edicion');
        $producto->logo_producto = $request->input('logo_producto');
        $producto->nomenclatura = $request->input('nomenclatura');
    
        $producto->save();

        return response()->json(['Producto' => $producto], 201);
        
    }

    public function delete($clave){

        $producto = Producto::find($clave);
        $producto->delete();

    }

    public function update(Request $request, $clave){

        $producto = Validator::make($request->all(), [
            'clave' => 'required',
            'nombre' => 'required',
            'edicion' => 'required',
            'nomenclatura' => 'required',
         ]);


         if($producto->fails()){
            return response()->json($producto->messages(), 400);
         }

        $producto = Producto::find($clave);
        $producto->nombre = $request->input('nombre');
        $producto->edicion = $request->input('edicion');
        $producto->logo_producto = $request->input('logo_producto');
        $producto->nomenclatura = $request->input('nomenclatura');
    
        $producto->save();
        return response()->json(['Producto' => $producto], 201);

    }
}
