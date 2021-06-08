<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ItemController extends Controller
{
    public function index($id)
    {
        $user = Auth::user();
        $item = Item::where('id', $id)->first();

        return view('item')->with(compact('user', 'item'));
    }
}
