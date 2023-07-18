<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function index()
    {
        return view('panel.table', ['service' => 'CitiesService', 'title' => 'المدن']);
    }
}
