<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function adminIndex()
    {
        return view('admin.index');
    }

    public function userIndex()
    {
        return view('user.index');
    }
}
