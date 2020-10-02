<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UsuariosHomeController extends Controller
{
    public function __construct()
    {
       // $this->middleware('auth:usuario');
    }
    public function index()
    {
        return view('home.usuario');
    }
}
