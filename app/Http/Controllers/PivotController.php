<?php

namespace App\Http\Controllers;

use App\Models\Pivot;
use App\Models\Producto;
use Illuminate\Http\Request;

class PivotController extends Controller
{
    public function index(){

        
        $pivots = Pivot::all();
        return $pivots;
        
    }

    public function create(Request $request){

        $pivot = new Pivot();

        $pivot->cve_producto = $request->input('cve_producto');
        $pivot->cve_proyecto = $request->input('cve_proyecto');
        $pivot->nolicencias = $request->input('nolicencias');
    
        $pivot->save();
        
    }

    public function delete($clave){

        $pivot = Pivot::find($clave);
        $pivot->delete();

    }

    public function update(Request $request, $clave){

        $pivot = Pivot::find($clave);
        
        $pivot->cve_producto = $request->input('cve_producto');
        $pivot->cve_proyecto = $request->input('cve_proyecto');
        $pivot->nolicencias = $request->input('nolicencias');
    
        $pivot->save();
        return $pivot;

    }
}
