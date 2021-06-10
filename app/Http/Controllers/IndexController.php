<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Item;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $categories = Category::all();
        $items = Item::where('stock', '>', '0')->get();

        return view('index')->with(compact('user', 'categories', 'items'));
    }
}
