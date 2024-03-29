<?php

namespace App\Http\Controllers\Admin;

use App\Models\Company;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AdminIndexController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $company = Company::first();
        $countSale = TransactionDetail::whereMonth('created_at', now()->month)->sum('quantity');
        $countTransaction = Transaction::whereMonth('date', now()->month)->count();

        return view('admin.admin_index')->with(compact('user', 'company', 'countSale', 'countTransaction'));
    }

    public function profile()
    {
        $user = Auth::user();
        $company = Company::first();

        return view('admin.admin_profile')->with(compact('user', 'company'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        if (!isset($request->password_1)) {
            User::where('id', $user->id)->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);
        } else {
            if (isset($request->password_2) && isset($request->password_3)) {
                if ($request->password_2 == $request->password_3) {
                    if (Hash::check($request->password_1, $user->password)) {
                        User::where('id', $user->id)->update([
                            'name' => $request->name,
                            'email' => $request->email,
                            'password' => bcrypt($request->password_2),
                        ]);
                    } else {
                        Session::flash('message', 'Password salah');
                    }

                } else {
                    Session::flash('message', 'Password tidak sama');
                }
            } else {
                Session::flash('message', 'Password tidak diisi');
            }
        }
        return redirect()->route('admin.profile.index');
    }
}
