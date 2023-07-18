<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class PanelViewsController extends Controller
{
    public function index()
    {
        return view('panel.index', ['title' => 'الرئيسية']);
    }
}
