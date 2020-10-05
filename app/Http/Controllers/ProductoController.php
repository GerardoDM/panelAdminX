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

        $producto = new Producto();

        $producto->nombre = $request->input('nombre');
        $producto->edicion = $request->input('edicion');
        $producto->logo_producto = $request->input('logo_producto');
        $producto->nomenclatura = $request->input('nomenclatura');
    
        $producto->save();
        
    }

    public function delete($clave){

        $producto = Producto::find($clave);
        $producto->delete();

    }

    public function update(Request $request, $clave){

        $producto = Producto::find($clave);
        $producto->nombre = $request->input('nombre');
        $producto->edicion = $request->input('edicion');
        $producto->logo_producto = $request->input('logo_producto');
        $producto->nomenclatura = $request->input('nomenclatura');
    
        $producto->save();
        return $producto;

    }
}
