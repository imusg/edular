<?php

namespace App\Http\Controllers\Megacrm;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Library\AccessControl;

class dashboardController extends Controller
{
    public function dashboardView() {
        $class = new AccessControl;
        return view('Megacrm.dashboardView')->with([
            'Admin' => $class->Admin(1)
        ]);
    }
}
