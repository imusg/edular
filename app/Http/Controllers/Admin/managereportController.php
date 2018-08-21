<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Library\AccessControl;

class managereportController extends Controller
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
        $qry = 'SELECT `id`, `name` FROM `report` WHERE 1';
        $reports = DB::select($qry);

        $qry = 'SELECT `id`, `name` FROM `users` WHERE 1';
        $users = DB::select($qry);

        $qry = 'SELECT `id`, `name` FROM `groups` WHERE 1';
        $groups = DB::select($qry);

        $class = new AccessControl;
        return view('Megacrm.admin.managereport')->with([
            'Admin' => $class->Admin(1),
            'Reports' => $reports,
            'Users' => $users,
            'Groups' => $groups
        ]);
    }

    public function getReportUser ($id) {
        $qry = "SELECT * FROM `access_report` WHERE `user_id` = '" . $id . "'";
        $ReportsAccess = DB::select($qry);


        $data = array();

            for ($i=0; $i < count($ReportsAccess); $i++) {
                $report_id = $ReportsAccess[$i]->report_id;
                $user_id = $ReportsAccess[$i]->user_id;
                $checked = $ReportsAccess[$i]->checked;

                $qry = "SELECT `name` FROM `report` WHERE `id` = '" . $report_id . "'";
                $Reports = DB::select($qry);
                $name = $Reports[0]->name;


                    $data[$i]['name'] = $name;
                    $data[$i]['report_id'] = $report_id;
                    $data[$i]['user_id'] = $user_id;
                    $data[$i]['checked'] = $checked;
            }


        return response()->json($data);
    }

    public function getReportGroup ($id) {
        $qry = "SELECT * FROM `access_report` WHERE `group_id` = '" . $id . "'";
        $ReportsAccess = DB::select($qry);

        $data = array();

        for ($i=0; $i < count($ReportsAccess); $i++) {
            $report_id = $ReportsAccess[$i]->report_id;
            $group_id = $ReportsAccess[$i]->group_id;
            $checked = $ReportsAccess[$i]->checked;

            $qry = "SELECT `name` FROM `report` WHERE `id` = '" . $report_id . "'";
            $Reports = DB::select($qry);
            $name = $Reports[0]->name;


            $data[$i]['name'] = $name;
            $data[$i]['report_id'] = $report_id;
            $data[$i]['group_id'] = $group_id;
            $data[$i]['checked'] = $checked;
        }


        return response()->json($data);

    }

    public function saveUserReport() {
        $data = json_decode($_REQUEST['data']);
        $id = $_REQUEST['id'];

        foreach ($data as $report_id => $checked) {
            $sql = "SELECT COUNT(*) as count FROM `access_report` WHERE `report_id` = '" . $report_id . "' and `user_id` = '" . $id . "'";
            $resp = DB::select($sql);

            if ($resp[0]->count > 0) {
                $sql = "UPDATE `access_report` SET `checked` = '" . $checked . "' WHERE `report_id` = '" . $report_id . "' and `user_id` = '" . $id . "'";
                $groups = DB::select($sql);
            } else {
                $sql = "INSERT INTO `access_report` (report_id, user_id, checked) VALUE ('" . $report_id . "', '" . $id . "', '" . $checked . "')";
                $groups = DB::select($sql);
            }
        }

        return response()->json($_REQUEST);
    }

    public function saveGroupReport() {
        $data = json_decode($_REQUEST['data']);
        $id = $_REQUEST['id'];

        foreach ($data as $report_id => $checked) {
            $sql = "SELECT COUNT(*) as count FROM `access_report` WHERE `report_id` = '" . $report_id . "' and `group_id` = '" . $id . "'";
            $resp = DB::select($sql);


            if ($resp[0]->count > 0) {
                $sql = "UPDATE `access_report` SET `checked` = '" . $checked . "' WHERE `report_id` = '" . $report_id . "' and `group_id` = '" . $id . "'";
                $groups = DB::select($sql);
            } else {
                $sql = "INSERT INTO `access_report` (report_id, group_id, checked) VALUE ('" . $report_id . "', '" . $id . "', '" . $checked . "')";
                $groups = DB::select($sql);
            }
        }
        return response()->json($_REQUEST);
//        foreach ($data as $id_report => $checked) {
//            $sql = "SELECT COUNT(*) as count FROM `megacrm_report_access` WHERE `id_report` = '" . $id_report . "' and `id_group` = '" . $id . "'";
//            if (!$result = $mysqli->query($sql)) {
//
//            }
//            $resp = $result->fetch_assoc();
//
//            if ($resp['count'] > 0) {
//                $sql = "UPDATE `megacrm_report_access` SET `checked` = '" . $checked . "' WHERE `id_report` = '" . $id_report . "' and `id_group` = '" . $id . "'";
//                if (!$mysqli->query($sql)) {
//
//                }
//            } else {
//                $sql = "INSERT INTO `megacrm_report_access` (id_report, id_group, checked) VALUE ('" . $id_report . "', '" . $id . "', '" . $checked . "')";
//                if (!$mysqli->query($sql)) {
//
//                }
//            }
//        }


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
