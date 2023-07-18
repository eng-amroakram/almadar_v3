<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class UserProfile extends Component
{
    public $user;

    public function render()
    {
        return view('livewire.user-profile');
    }

    public function mount($user_id)
    {
        $this->user = User::find($user_id);
    }
}
