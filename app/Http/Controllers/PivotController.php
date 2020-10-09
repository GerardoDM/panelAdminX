<?php

namespace App\Http\Controllers;

use App\Models\Pivot;
use App\Models\Producto;
use \Validator;
use Illuminate\Http\Request;

class PivotController extends Controller
{
    public function index(){

        
        $pivots = Pivot::all();
        return $pivots;
        
    }

    public function create(Request $request){


        $pivot = Validator::make($request->all(), [
            'cve_producto' => 'required',
            'cve_proyecto' => 'required',
            'nolicencias' => 'required',
         ]);


         if($pivot->fails()){
            return response()->json($pivot->messages(), 400);
         }

        $pivot = new Pivot();

        $pivot->cve_producto = $request->input('cve_producto');
        $pivot->cve_proyecto = $request->input('cve_proyecto');
        $pivot->nolicencias = $request->input('nolicencias');
    
        $pivot->save();

        return response()->json(['Relación' => $pivot], 201);

        
    }

    public function delete($clave){

        $pivot = Pivot::find($clave);
        $pivot->delete();

    }

    public function update(Request $request, $clave){

        $pivot = Validator::make($request->all(), [
            'cve_producto' => 'required',
            'cve_proyecto' => 'required',
            'nolicencias' => 'required',
         ]);


         if($pivot->fails()){
            return response()->json($pivot->messages(), 400);
         }

        $pivot = Pivot::find($clave);
        
        $pivot->cve_producto = $request->input('cve_producto');
        $pivot->cve_proyecto = $request->input('cve_proyecto');
        $pivot->nolicencias = $request->input('nolicencias');
    
        $pivot->save();
        return response()->json(['Relación' => $pivot], 201);

    }
}
