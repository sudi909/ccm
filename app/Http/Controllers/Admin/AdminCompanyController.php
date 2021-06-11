<?php

namespace App\Http\Controllers\Admin;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Kavist\RajaOngkir\Facades\RajaOngkir;

class AdminCompanyController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $company = Company::first();
        $provinces = RajaOngkir::provinsi()->all();

        return view('admin.admin_company')->with(compact('user', 'company', 'provinces'));
    }

    public function update(Request $request)
    {
        if ($request->file('logo')) {
            $imagePath1 = $request->file('logo');
            $imageName1 = $imagePath1->getClientOriginalName();

            $path1 = $request->file('logo')->storeAs('item', $imageName1, 'public_uploads');

            Company::first()->update([
                'company_name' => $request->company_name,
                'logo_path' => $path1,
                'phone_number' => $request->phone_number,
                'address' => $request->address,
                'province_id' => $request->province_id,
                'city_id' => $request->city_id,
                'email' => $request->email,
                'about' => $request->about,
            ]);
        } else {
            Company::first()->update([
                'company_name' => $request->company_name,
                'phone_number' => $request->phone_number,
                'address' => $request->address,
                'province_id' => $request->province_id,
                'city_id' => $request->city_id,
                'email' => $request->email,
                'about' => $request->about,
            ]);
        }

        return redirect()->route('admin.company.index');
    }

    public function getCities($id)
    {
        $cities = RajaOngkir::kota()->dariProvinsi($id)->get();

        return response()->json($cities);
    }
}
