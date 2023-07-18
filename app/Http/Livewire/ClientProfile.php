<?php

namespace App\Http\Livewire;

use App\Models\Client;
use Livewire\Component;

class ClientProfile extends Component
{
    public $client;

    public function render()
    {
        return view('livewire.client-profile');
    }

    public function mount($client_id)
    {
        $this->client = Client::find($client_id);
    }
}
