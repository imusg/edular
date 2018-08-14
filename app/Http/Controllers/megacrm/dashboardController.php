<?php

namespace App\Http\Controllers\megacrm;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class dashboardController extends Controller
{
    public function dashboardView() {
        return view('megacrm.dashboardView');
    }
}
