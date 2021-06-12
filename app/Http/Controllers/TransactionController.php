<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Company;
use App\Models\Item;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $company = Company::first();
        return view('transaction')->with(compact('user', 'company'));
    }

    public function payment()
    {
        $user = Auth::user();
        $company = Company::first();
        return view('payment')->with(compact('user', 'company'));
    }

    public function create(Request $request)
    {
        $user = Auth::user();
        $company = Company::first();
        $grandTotal = $request->grand_total;
        if(Auth::user()) {
            $cartItems = Cart::where('user_id', $user->id)->get();
            $transaction = Transaction::orderBy('id', 'DESC')->first();
            if ($transaction) {
                $code = date('Ymd') . "/" . ($transaction->id + 1);
            } else {
                $code = date('Ymd') . "/" . 1;
            }
            $transaction = Transaction::create([
                'user_id' => Auth::user()->id,
                'code' => $code,
                'date' => now(),
                'customer_name' => $request->name,
                'phone_number' => $request->phone_number,
                'province' => $request->province,
                'city' => $request->city,
                'address' => $request->address,
                'status' => '1', // 1: menunggu pembayaran, 2: sedang diproses, 3: pesanan selesai
                'shipping' => $request->shipping,
                'shipping_price' => $request->shipping_price,
                'total_price' => $request->total_price,
                'grand_total' => $request->grand_total,
            ]);
            foreach ($cartItems as $cartItem) {
                $item = Item::where('id', $cartItem->item_id)->first();
                $stock = $item->stock - $cartItem->quantity;
                Item::where('id', $cartItem->item_id)->update([
                    'stock' => $stock,
                ]);

                TransactionDetail::create([
                    'transaction_id' => $transaction->id,
                    'item_id' => $cartItem->item_id,
                    'quantity' => $cartItem->quantity,
                    'price' => $cartItem->item->price,
                    'total' => $cartItem->item->price * $cartItem->quantity,
                ]);
            }
        }
        return view('payment')->with(compact('user', 'company', 'grandTotal'));
    }

    public function proof($id)
    {
        $user = Auth::user();
        $company = Company::first();
        $transaction = Transaction::where('id', $id)->first();
        return view('proof')->with(compact('user', 'company', 'transaction'));
    }

    public function update(Request $request)
    {
        if ($request->file('imgInp')) {
            $imagePath = $request->file('imgInp');
            $imageName = $imagePath->getClientOriginalName();

            $path = $request->file('imgInp')->storeAs('proof', $imageName, 'public_uploads');
            Transaction::where('id', $request->id)->update([
                'status' => '2',
                'payment_date' => now(),
                'payment_path' => $path,
            ]);

            return redirect()->route('transaction.index');
        }
    }
}
