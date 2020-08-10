<?php

namespace App\Http\Controllers;

class indexController extends Controller
{
    public function info()
    {
        phpinfo();
    }
}