<?php

namespace App\Http\Controllers\megacrm;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CounterpartiesController extends Controller
{
    public function CounterpartiesList() {
        return view('megacrm.counterparties.list');
    }
}
