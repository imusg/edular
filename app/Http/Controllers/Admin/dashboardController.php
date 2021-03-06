<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Library\AccessControl;

class dashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $qry = 'SELECT `id`, `name` FROM `users` WHERE 1';
        $ppl = DB::select($qry);

        $class = new AccessControl;
        return view('Megacrm.admin.dashboard')->with([
            'Admin' => $class->Admin(1),
            'Users' => $ppl
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $qry = "SELECT COUNT(*) as cnt FROM `admins` WHERE `user_id` = '" . $_REQUEST['newAdmin'] . "'";
        $ppl = DB::select($qry);

        if ($ppl[0]->cnt >= "1") {
            return view("Megacrm.admin.responseAjax")->with(['response' => "exist"]);
        } else {
            $qry = "INSERT INTO `admins` (`user_id`) VALUE ('" . $_REQUEST['newAdmin'] . "')";
            $ppl = DB::select($qry);
            return view("Megacrm.admin.responseAjax")->with(['response' => "OK"]);
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
