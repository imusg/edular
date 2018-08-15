<?php

namespace App\Http\Controllers\Megacrm;

use App\Counterparties;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use App\User;
use App\Http\Controllers\Controller;
use Library\AccessControl;

class CounterpartiesController extends Controller
{


    public function show($page)
    {
        $class = new AccessControl;
        return view('Megacrm.counterparties.list')->with([
            'Admin' => $class->Admin(1)
        ]);
    }



}
