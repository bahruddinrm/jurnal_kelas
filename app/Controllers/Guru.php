<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Guru extends BaseController
{
    public function index()
    {
        $ModelUser = new \App\Models\User();
        $user = session()->get('user');

        return view('/guru/dashboard_guru_view', $user);
    }
}
