<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Company;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Kavist\RajaOngkir\Facades\RajaOngkir;

class CartController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $company = Company::first();

        return view('cart')->with(compact('user', 'company'));
    }

    public function create(Request $request)
    {
        if(Auth::user()) {
            $item = Item::where('id', $request->id)->first();
            if($item->stock > $request->quantity) {
                Cart::updateOrCreate([
                    'item_id' => $request->id,
                    'user_id' => Auth::user()->id,
                ],[
                    'quantity' => $request->quantity,
                ]);
            } else {
                Session::flash('message', 'Stock tidak cukup');
            }
        }
        return redirect()->route('index');
    }

    public function update(Request $request)
    {
        if(Auth::user()) {
            $item = Item::where('id', $request->id)->first();
            if($item->stock > $request->quantity) {
                Cart::where('item_id', $request->id)->where('user_id', Auth::user()->id)->update([
                    'quantity' => $request->quantity,
                ]);
            } else {
                Session::flash('message', 'Stock tidak cukup');
            }
        }
        return redirect()->route('cart.index');
    }

    public function updateAjax($id, $quantity)
    {
        if(Auth::user()) {
            $item = Item::where('id', $id)->first();
            if($item->stock > $quantity) {
                Cart::where('item_id', $id)->where('user_id', Auth::user()->id)->update([
                    'quantity' => $quantity,
                ]);
            } else {
                Session::flash('message', 'Stock tidak cukup');
            }
        }
    }

    public function destroy($id)
    {
        if(Auth::user()) {
            Cart::where('item_id', $id)->where('user_id', Auth::user()->id)->delete();
        }
        return redirect()->route('cart.index');
    }

    public function checkout()
    {
        $user = Auth::user();
        $company = Company::first();
        $provinces = RajaOngkir::provinsi()->all();

        return view('checkout')->with(compact('user', 'company', 'provinces'));
    }

    public function getCities($id)
    {
        $cities = RajaOngkir::kota()->dariProvinsi($id)->get();

        return response()->json($cities);
    }

    public function getShipping($id, $weight)
    {
        $company = Company::first();

        $costs = RajaOngkir::ongkosKirim([
            'origin'        => $company->city_id,
            'destination'   => $id,
            'weight'        => $weight,
            'courier'       => 'jne'
        ])->get();

        return response()->json($costs);
    }
}
