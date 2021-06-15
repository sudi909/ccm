<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class AdminCategoryController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $company = Company::first();
        $categories = Category::all();

        return view('admin.admin_category')->with(compact('user', 'company', 'categories'));
    }

    public function create(Request $request)
    {
        Category::create([
            'name' => $request->name,
        ]);

        return redirect()->route('admin.category.index');
    }

    public function update(Request $request)
    {
        Category::where('id', $request->id)->update([
            'name' => $request->name,
        ]);

        return redirect()->route('admin.category.index');
    }

    public function destroy($id)
    {
        Category::where('id', $id)->delete();

        return redirect()->route('admin.category.index');
    }
}
