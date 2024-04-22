<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Kepsek extends BaseController
{
    public function index()
    {
        $ModelUser = new \App\Models\User();
        $user = session()->get('user');

        return view('kepsek/dashboard_kepsek_view', $user);
    }
}
