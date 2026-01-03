<?php

namespace App\Http\Controllers;

class AccessController extends Controller
{
    public function roles()
    {
        $this->authorize('user::manage');

        return $this->extendedView('access.role', [], 'roles');
    }

    public function permissions()
    {
//        $this->authorize('can view roles');

        return $this->extendedView('access.role', [], 'permissions');
    }
}
