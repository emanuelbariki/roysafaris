<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //

    public function index() {

        $tData['title'] = "Dashboard";
        return view('dashboard', $tData);
    }
}
