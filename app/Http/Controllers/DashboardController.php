<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct() {
        parent::__construct();
    }

    public function getIndex(Request $request)
    {
        return View('dashboard.index');
    }
}