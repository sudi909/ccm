<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    protected function index(Request $request)
    {
        User::create([
            'name' => $request->name,
            'level' => '2',
            'birthdate' => $request->birthdate,
            'phone_number' => $request->phone_number,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        return redirect()->route('index');
    }
}
