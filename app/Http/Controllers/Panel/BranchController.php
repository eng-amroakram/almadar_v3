<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    public function index()
    {
        return view('panel.table', ['service' => 'BranchesService', 'title' => 'الفروع']);
    }
}
