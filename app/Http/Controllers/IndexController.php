<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Company;
use App\Models\Item;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $company = Company::first();
        $categories = Category::all();
        $items = Item::where('stock', '>', '0')->get();

        return view('index')->with(compact('user', 'company', 'categories', 'items'));
    }

    public function category($id)
    {
        if($id != '0') {
            $items = Item::where('stock', '>', '0')->where('category_id', $id)->get();
        } else {
            $items = Item::where('stock', '>', '0')->get();
        }

        return response()->json($items);
    }

    public function search($name)
    {
        if(isset($name) != '') {
            $items = Item::where('stock', '>', '0')->where('name', 'like', '%' . $name . '%')->get();
        } else {
            $items = Item::where('stock', '>', '0')->get();
        }

        return response()->json($items);
    }
}
