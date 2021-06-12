<?php

namespace App\Http\Controllers\Admin;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class AdminIndexController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $company = Company::first();

        return view('admin.admin_index')->with(compact('user', 'company'));
    }
}
