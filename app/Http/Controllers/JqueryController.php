<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JqueryController extends Controller
{
    public function index(){
        return view('jquery');
    }

    public function ajax_get(){
        $data = "<h2>Changed with jquery</h2>";
        return response($data);
    }

    public function ajax_post(Request $request){
        return response($request->name);
    }
}
