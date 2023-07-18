<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function index()
    {
        $user = auth()->user();
        if ($user) {
            if (in_array($user->user_type, ['superadmin', 'admin', 'office', 'marketer'])) {
                return redirect()->route('panel.index');
            }
        }
        return redirect()->route('web.index');
    }
}
