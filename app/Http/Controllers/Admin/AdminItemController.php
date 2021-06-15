<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\Company;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class AdminItemController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $company = Company::first();
        $categories = Category::all();
        $items = Item::all();

        return view('admin.admin_item')->with(compact('user', 'company', 'items', 'categories'));
    }

    public function create(Request $request)
    {
        $path1 = null;
        $path2 = null;
        $path3 = null;
        if ($request->file('image_1')) {
            $imagePath1 = $request->file('image_1');
            $imageName1 = $imagePath1->getClientOriginalName();

            $path1 = $request->file('image_1')->storeAs('item', $imageName1, 'public_uploads');
        }

        if ($request->file('image_2')) {
            $imagePath2 = $request->file('image_2');
            $imageName2 = $imagePath2->getClientOriginalName();

            $path2 = $request->file('image_2')->storeAs('item', $imageName2, 'public_uploads');
        }

        if ($request->file('image_3')) {
            $imagePath3 = $request->file('image_3');
            $imageName3 = $imagePath3->getClientOriginalName();

            $path3 = $request->file('image_3')->storeAs('item', $imageName3, 'public_uploads');
        }

        Item::create([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'price' => $request->price,
            'weight' => $request->weight,
            'stock' => $request->stock,
            'description' => $request->description,
            'image_1' => $path1,
            'image_2' => $path2,
            'image_3' => $path3,
        ]);

        return redirect()->route('admin.item.index');
    }

    public function update(Request $request)
    {
        $path1 = null;
        $path2 = null;
        $path3 = null;
        if ($request->file('image_1')) {
            $imagePath1 = $request->file('image_1');
            $imageName1 = $imagePath1->getClientOriginalName();

            $path1 = $request->file('image_1')->storeAs('item', $imageName1, 'public_uploads');
        }

        if ($request->file('image_2')) {
            $imagePath2 = $request->file('image_2');
            $imageName2 = $imagePath2->getClientOriginalName();

            $path2 = $request->file('image_2')->storeAs('item', $imageName2, 'public_uploads');
        }

        if ($request->file('image_3')) {
            $imagePath3 = $request->file('image_3');
            $imageName3 = $imagePath3->getClientOriginalName();

            $path3 = $request->file('image_3')->storeAs('item', $imageName3, 'public_uploads');
        }

        Item::where('id', $request->id)->update([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'price' => $request->price,
            'weight' => $request->weight,
            'stock' => $request->stock,
            'description' => $request->description,
            'image_1' => $path1,
            'image_2' => $path2,
            'image_3' => $path3,
        ]);

        return redirect()->route('admin.item.index');
    }

    public function destroy($id)
    {
        Item::where('id', $id)->delete();

        return redirect()->route('admin.item.index');
    }
}
