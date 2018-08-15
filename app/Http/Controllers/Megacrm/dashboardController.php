<?php

namespace App\Http\Controllers\Megacrm;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class dashboardController extends Controller
{
    public function dashboardView() {
        return view('Megacrm.dashboardView');
    }
}
