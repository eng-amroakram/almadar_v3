<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BrokerController extends Controller
{
    public function index()
    {
        return view('panel.table', ['service' => 'BrokersService', 'title' => 'الوسطاء']);
    }
}
