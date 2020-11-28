<?php

namespace App\Http\Controllers;

use App\Models\Pivot;
use App\Models\Producto;
use \Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PivotController extends Controller
{


    public function view(){

        return view('pages.pivot');
        
    }

    public function viewDetail(){
        return view('pages.pivotDetalle');
    }


    public function index(){

        
        $pivots = Pivot::all();
        return $pivots;

        // $data = Pivot::select('pivot.cve_producto', 'pivot.cve_proyecto','pivot.nolicencias')
        //         ->join('producto', function($query){
        //                $query->leftjoin('pivot.cve_producto','=','producto.clave')
        //                  ->select('producto.nombre ');
        //     })->get();

        // return $data;
    
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

    public function join(){

        $pivots = DB::select('select `producto-proyecto`.clave , `producto-proyecto`.cve_producto, `producto-proyecto`.cve_proyecto ,producto.nombre as `prodNombre`, proyecto.nombre as `proyNombre`, `producto-proyecto`.nolicencias from `producto-proyecto` inner join producto on `producto-proyecto`.cve_producto = producto.clave inner join proyecto on
        `producto-proyecto`.cve_proyecto = proyecto.clave');

        

        return $pivots;

    }

    public function joinShow($clave){

        $pivot = DB::table('producto-proyecto')
            ->join('producto', 'producto.clave', '=', 'producto-proyecto.cve_producto')
            ->join('proyecto', 'proyecto.clave', '=', 'producto-proyecto.cve_proyecto')
            ->select('producto.nombre as productoNombre', 'proyecto.nombre as proyectoNombre', 'producto-proyecto.nolicencias')
            ->where('producto-proyecto.clave', '=', $clave)
            ->get();

         return $pivot;   
    }

    public function show($clave){

        $pivot = Pivot::find($clave);
        return $pivot;

    }

    
}
