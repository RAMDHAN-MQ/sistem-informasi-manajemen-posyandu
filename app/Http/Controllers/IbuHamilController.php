<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IbuHamilController extends Controller
{
    public function index()
    {
        return view('admin.ibu.index');
    }
}
