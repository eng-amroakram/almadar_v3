<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WebViewsController extends Controller
{
    public function index()
    {
        return view('web.index');
    }
}
