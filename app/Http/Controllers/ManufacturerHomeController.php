<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ManufacturerHomeController extends Controller
{
    //
    public function index(){
        return view('manufacturer.dashboard');
    }
}
