<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function adminIndex()
    {
        $userCount = User::count();
        $feedbackCount = Feedback::count();
        return view('admin.index', compact('userCount', 'feedbackCount'));
    }
}
