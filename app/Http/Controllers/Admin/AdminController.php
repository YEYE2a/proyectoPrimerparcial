<?php

namespace App\Http\Controllers\Admin;

use App\Models\Evento;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;



class AdminController extends Controller
{
    public function index()
    {
        return redirect()->route('admin.eventos.index');
    }
    
    
}
