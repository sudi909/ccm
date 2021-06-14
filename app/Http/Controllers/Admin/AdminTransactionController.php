<?php

namespace App\Http\Controllers\Admin;

use App\Exports\TransactionsExport;
use App\Models\Company;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Kavist\RajaOngkir\Facades\RajaOngkir;
use Maatwebsite\Excel\Facades\Excel;

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

    public function report(Request $request)
    {
        $user = Auth::user();
        $company = Company::first();
        if ($request->status == '0') {
            $transactions = Transaction::whereBetween('date', [$request->firstDate, $request->lastDate])->get();
        } else {
            $transactions = Transaction::whereBetween('date', [$request->firstDate, $request->lastDate])->where('status', $request->status)->get();
        }
        $firstDate = $request->firstDate;
        $lastDate = $request->lastDate;
        $status = $request->status;

        return view('admin.admin_report')->with(compact('user', 'company', 'transactions', 'firstDate', 'lastDate', 'status'));
    }

    public function export(Request $request)
    {
        return Excel::download(new TransactionsExport($request->firstDate, $request->lastDate, $request->status), 'report.xlsx');
    }
}
