<?php

namespace App\Http\Controllers;

use App\Models\Pivot;
use App\Models\Producto;
use Illuminate\Http\Request;

class PivotController extends Controller
{
    public function index(){

        
        $productos = Pivot::all();


        return $productos;
        
    }
}
