<?php

namespace App\Http\Controllers;

use App\Models\Cart;
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
        return view('transaction')->with(compact('user'));
    }

    public function payment(Request $request)
    {
        $user = Auth::user();
        return view('payment')->with(compact('user'));
    }

    public function create(Request $request)
    {
        $user = Auth::user();
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
                'address' => $request->address,
                'status' => '1', // 1: menunggu pembayaran, 2: sendang diproses, 3: pesanan selesai
                'grand_total' => $request->grandTotal,
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
        return redirect()->route('payment.index');
    }

    public function proof($id)
    {
        $user = Auth::user();
        $transaction = Transaction::where('id', $id)->first();
        return view('proof')->with(compact('user', 'transaction'));
    }

    public function edit(Request $request)
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
