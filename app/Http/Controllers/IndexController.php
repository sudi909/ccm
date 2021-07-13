<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Company;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $company = Company::first();
        $categories = Category::all();
        $items = Item::where('stock', '>', '0')->paginate(12);

        return view('index')->with(compact('user', 'company', 'categories', 'items'));
    }

    public function category($id)
    {
        $user = Auth::user();
        $company = Company::first();
        $categories = Category::all();
        if($id != '') {
            $items = Item::where('stock', '>', '0')->where('category_id', $id)->paginate(12);
        } else {
            $items = Item::where('stock', '>', '0')->paginate(12);
        }

        return view('index')->with(compact('user', 'company', 'categories', 'items', 'id'));

//        return response()->json($items);
    }

    public function search(Request $request)
    {
        $user = Auth::user();
        $company = Company::first();
        $categories = Category::all();
        $search = $request->search;
        if(isset($search) != '') {
            $items = Item::where('stock', '>', '0')->where('name', 'like', '%' . $search . '%')->paginate(12);
        } else {
            return redirect()->route('index');
//            $items = Item::where('stock', '>', '0')->get();
        }

        return view('index')->with(compact('user', 'company', 'categories', 'items', 'search'));

//        return response()->json($items);
    }

    public function about()
    {
        $user = Auth::user();
        $company = Company::first();
        $categories = Category::all();
        $items = Item::where('stock', '>', '0')->paginate(12);

        return view('about')->with(compact('user', 'company', 'categories', 'items'));
    }
}
