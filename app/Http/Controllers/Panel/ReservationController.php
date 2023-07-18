<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;

class ReservationController extends Controller
{
    public function index()
    {
        return view('panel.table', ['service' => 'ReservationsService', 'title' => 'الحجوزات']);
    }
}
