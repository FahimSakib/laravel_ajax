<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JavaScriptController extends Controller
{
    public function index(){
        return view('javascript');
    }

    public function ajax_post(Request $request)
    {
        
        return response($request->name);
       
    }
}
