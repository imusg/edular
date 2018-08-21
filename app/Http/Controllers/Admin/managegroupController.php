<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Library\AccessControl;

class managegroupController extends Controller
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
        $sql = "SELECT * FROM `groups` GROUP BY `id`";
        $Groups = DB::select($sql);
        $data = array();

        for ($i=0; $i < count($Groups); $i++) {
            $id = $Groups[$i]->id;
            $name = $Groups[$i]->name;
            $description = $Groups[$i]->description;

            $data[$i]['id'] = $id;
            $data[$i]['name'] = $name;
            $data[$i]['description'] = $description;
        }

        $sql = 'SELECT `id`, `name` FROM `users` WHERE 1';
        $Users = DB::select($sql);

        $class = new AccessControl;
        return view('Megacrm.admin.managegroup')->with([
            'Admin' => $class->Admin(1),
            'Groups' => $data,
            'Users' => $Users
        ]);
    }

    public function getUserInGroup () {
        $id = $_REQUEST['id'];

        $sql = "SELECT * FROM `user_groups` WHERE `group_id` = '" . $id . "'";
        $UserInGroup = DB::select($sql);
        $data = array();

        for ($i=0; $i < count($UserInGroup); $i++) {
            $group_id = $UserInGroup[$i]->group_id;
            $user_id = $UserInGroup[$i]->user_id;

            $sql = "SELECT * FROM `users` WHERE `id` = '" . $user_id . "'";
            $User = DB::select($sql);

            $data[$i]['name'] = $User[0]->name . " " . $User[0]->last_name;
            $data[$i]['id'] = $user_id;
        }


        return response()->json($data);
    }

    public function searchUser() {
        $name = $_REQUEST['name'];

        $sql = "SELECT `id`, `name`, `last_name` FROM `users` WHERE `last_name` LIKE '%" . $name . "%'";
        $Users = DB::select($sql);

        return response()->json($Users);
    }

    public function addUserToGroup() {

        if (!empty($_REQUEST['users'])) {
            if (!empty($_REQUEST['group'])) {
                $sql = "SELECT `name` FROM `groups` WHERE `id` = '" .  $_REQUEST['group']. "'";
                $Groups = DB::select($sql);

                $name = $Groups[0]->name;
                $sql = "INSERT INTO `user_groups` (`group_id`, `user_id`, `discription`) VALUES ('" . $_REQUEST['group'] . "', '" . $_REQUEST['users'] . "', '" . $name . "')";
                $Groups = DB::select($sql);
            }
        }
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
