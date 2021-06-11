<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class AdminUserController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $users = User::all();

        return view('admin.admin_user')->with(compact('user', 'users'));
    }

    public function update(Request $request)
    {
        User::where('id', $request->id)->update([
            'level' => '2',
        ]);

        return redirect()->route('admin.user.index');
    }

    public function reset(Request $request)
    {
       User::where('id', $request->id)->update([
            'password' => bcrypt('123456'),
        ]);

        return redirect()->route('admin.user.index');
    }
}
