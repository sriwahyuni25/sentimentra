<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function admin()
    {
        return view('admin.dashboard.index');
    }

    public function testaja()
    {
        return view('admin.test.index');
    }

    public function test(Request $request)
    {
    }

    public function guest()
    {
        return view('guest.index');
    }
}
