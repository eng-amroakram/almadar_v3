<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{

    public function index()
    {
        return view('panel.table', ['service' => "ClientsService", 'title' => 'العملاء']);
    }

    public function profile(Client $client)
    {
        return view('panel.clients.profile', ['client' => $client, 'title' => 'العميل']);
    }
}
