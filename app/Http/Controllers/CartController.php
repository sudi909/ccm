<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        return view('cart')->with(compact('user'));
    }

    public function create(Request $request)
    {
        if(Auth::user()) {
            Cart::create([
                'item_id' => $request->id,
                'user_id' => Auth::user()->id,
                'quantity' => $request->quantity,
            ]);
        }
        return redirect()->route('index');
    }

    public function update(Request $request)
    {
        if(Auth::user()) {
            Cart::where('item_id', $request->id)->where('user_id', Auth::user()->id)->update([
                'quantity' => $request->quantity,
            ]);
        }
        return redirect()->route('index');
    }

    public function destroy($id)
    {
        if(Auth::user()) {
            Cart::where('item_id', $id)->where('user_id', Auth::user()->id)->delete();
        }
        return redirect()->route('index');
    }

    public function checkout()
    {
        $user = Auth::user();

        return view('checkout')->with(compact('user'));
    }
}
