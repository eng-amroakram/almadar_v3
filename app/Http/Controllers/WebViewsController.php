<?php

namespace App\Http\Controllers;

use App\Imports\ColumnImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class WebViewsController extends Controller
{
    public function index()
    {
        return view('web.index');
    }

    public function excel()
    {
        ini_set('memory_limit', '1024M'); // Increase memory limit if needed
        $filePath = public_path('test.xlsx'); // Use correct file extension
        Excel::import(new ColumnImport, $filePath);
    }
}
