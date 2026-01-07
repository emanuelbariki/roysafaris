<?php

namespace App\Http\Controllers;

class DashboardController extends Controller
{
    public function __invoke()
    {
        return $this->extendedView(view: 'dashboard', data: [], title: 'Dashboard');
    }
}
