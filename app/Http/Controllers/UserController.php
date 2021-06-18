<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Kavist\RajaOngkir\Facades\RajaOngkir;

class UserController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $company = Company::first();
        $provinces = RajaOngkir::provinsi()->all();

        return view('profile')->with(compact('user', 'company', 'provinces'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        if (!isset($request->password_1)) {
            User::where('id', $user->id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'birthdate' => $request->birthdate,
                'address' => $request->address,
                'phone_number' => $request->phone_number,
                'province_id' => $request->province_id,
                'city_id' => $request->city_id,
            ]);
        } else {
            if (isset($request->password_2) && isset($request->password_3)) {
                if ($request->password_2 == $request->password_3) {
                    if (Hash::check($request->password_1, $user->password)) {
                        User::where('id', $user->id)->update([
                            'name' => $request->name,
                            'email' => $request->email,
                            'birthdate' => $request->birthdate,
                            'address' => $request->address,
                            'phone_number' => $request->phone_number,
                            'province_id' => $request->province_id,
                            'city_id' => $request->city_id,
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
        return redirect()->route('user.index');
    }

    public function getCities($id)
    {
        $cities = RajaOngkir::kota()->dariProvinsi($id)->get();

        return response()->json($cities);
    }
}
