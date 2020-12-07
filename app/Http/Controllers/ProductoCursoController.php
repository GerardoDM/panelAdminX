<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Validator;
use Illuminate\Support\Facades\DB;
use App\Models\PivotProductoCurso;


class ProductoCursoController extends Controller
{
    




    public function view(){

        return view('pages.pivotProductoCurso');
        
    }

    public function viewDetail(){
        return view('pages.productoCursoDetalle');
    }


    public function index(){

        
        $pivots = PivotProductoCurso::all();
        return $pivots;

        // $data = Pivot::select('pivot.cve_producto', 'pivot.cve_curso','pivot.nolicencias')
        //         ->join('producto', function($query){
        //                $query->leftjoin('pivot.cve_producto','=','producto.clave')
        //                  ->select('producto.nombre ');
        //     })->get();

        // return $data;
    
    }

    public function create(Request $request){


        $pivot = Validator::make($request->all(), [
            'cve_curso' => 'required',
            'cve_producto' => 'required',
            
         ]);


         if($pivot->fails()){
            return response()->json($pivot->messages(), 400);
         }

        $pivot = new PivotProductoCurso();

        $pivot->cve_producto = $request->input('cve_producto');
        $pivot->cve_curso = $request->input('cve_curso');
    
        $pivot->save();

        return response()->json(['Relación' => $pivot], 201);

        
    }

    public function delete($cve_curso, $cve_producto){

        $pivot = PivotProductoCurso::where('cve_curso', $cve_curso)->where('cve_producto', $cve_producto)->delete();
        return response()->json(['Relación borada' => $pivot], 201);
        

    }

    public function update(Request $request, $cve_curso, $cve_producto){

        $pivot = Validator::make($request->all(), [
            'cve_producto' => 'required',
            'cve_curso' => 'required',
        
         ]);


         if($pivot->fails()){
            return response()->json($pivot->messages(), 400);
         }

         $pivot->cve_producto = $request->input('cve_producto');
         $pivot->cve_curso = $request->input('cve_curso');

        $pivot = PivotProductoCurso::where('cve_curso', $cve_curso)->where('cve_producto', $cve_producto)->update(['cve_producto' => $pivot->cve_producto]);
        
       
        
    
        
        return response()->json(['Relación actualizada' => $pivot], 201);

    }

    public function join(){

        $pivots = DB::select('select `producto_curso`.cve_curso , `producto_curso`.cve_producto, producto.nombre as `nombreProducto` , curso.nombre as `nombreCurso` from `producto_curso` inner join producto on `producto_curso`.cve_producto = producto.clave inner join curso on `producto_curso`.cve_curso = curso.clave');

        

        return $pivots;

    }

    public function joinShow($cve_curso, $cve_producto){

        $pivot = DB::table('producto_curso')
            ->join('producto', 'producto.clave', '=', 'producto_curso.cve_producto')
            ->join('curso', 'curso.clave', '=', 'producto_curso.cve_curso')
            ->select('producto.nombre as productoNombre', 'curso.nombre as cursoNombre', 
            'producto.nomenclatura as productoNomenclatura', 'producto.edicion as productoEdicion', 
            'curso.blib as cursoBlib', 'curso.btotales as cursoBtotales', 'curso.autor as cursoAutor')
            ->where('producto_curso.cve_curso', '=', $cve_curso)
            ->where('producto_curso.cve_producto', '=', $cve_producto)
            ->get();

         return $pivot;   
    }

    public function show($clave){

        $pivot = Pivot::find($clave);
        return $pivot;

    }

    


}
