<?php

namespace App\Http\Controllers\megacrm;

use App\Counterparties;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CounterpartiesController extends Controller
{

    public function __invoke($id)
    {
//        return view('megacrm.counterparties.list', [
//            'counterparties' => Counterparties::paginate(50),
//            'request' => $request
//        ]);
        return view($id);
    }



}
