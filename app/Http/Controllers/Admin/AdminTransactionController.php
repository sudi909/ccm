<?php

namespace App\Http\Controllers\Admin;

use App\Models\Company;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Kavist\RajaOngkir\Facades\RajaOngkir;

class AdminTransactionController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $company = Company::first();
        $transactions = Transaction::all();
        $provinces = RajaOngkir::provinsi()->all();

        return view('admin.admin_transaction')->with(compact('user', 'company', 'transactions', 'provinces'));
    }

    public function update(Request $request)
    {
        Transaction::where('id', $request->id)->update([
            'resi' => $request->resi,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.transaction.index');
    }

    public function getCities($id)
    {
        $cities = RajaOngkir::kota()->dariProvinsi($id)->get();

        return response()->json($cities);
    }
}
