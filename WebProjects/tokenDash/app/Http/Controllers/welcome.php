<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class welcome extends Controller
{
    public function index()
    {
    	// echo "HI"; exit;
        $settings = \App\Admin::first();
    	     $myFile = base_path().'/resources/views/setup.blade.php';
            // echo $myFile; exit;
            // File::delete($myFile);
        return view('landing',compact('settings'));
    }
}
