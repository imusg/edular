<?php

namespace App\Http\Controllers\Megacrm;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Library\AccessControl;

class cardViewController extends Controller
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

    private function getAddress($id) {
        $sql = "SELECT * FROM counterparties_address WHERE `id_company` = '" . $id . "'";
        $Address = DB::select($sql);

        $legalAddress = "";

        $Country = $this->getCountry();

        if (!empty($Address[0]->postal_code)){
            $legalAddress .= $Address[0]->postal_code . ", ";
        }
        $legalAddress .= $Country[$Address[0]->country] . ", ";
        if (!empty($Address[0]->region)){
            $legalAddress .= $Address[0]->region . ", ";
        }
        if (!empty($Address[0]->province)){
            $legalAddress .= $Address[0]->province . ", ";
        }
        if (!empty($Address[0]->city)){
            $legalAddress .= $Address[0]->city . ", ";
        }
        if (!empty($Address[0]->street)){
            $legalAddress .= $Address[0]->street . ", ";
        }
        if (!empty($Address[0]->home)){
            $legalAddress .= $Address[0]->home . ", ";
        }
        if (!empty($Address[0]->corpus)){
            $legalAddress .= $Address[0]->corpus . ", ";
        }
        if (!empty($Address[0]->apartament)){
            $legalAddress .= $Address[0]->apartament . ", ";
        }

        $faktAddress = "";

        if (!empty($Address[1]->postal_code)){
            $faktAddress .= $Address[1]->postal_code . ", ";
        }
        $faktAddress .= $Country[$Address[1]->country] . ", ";
        if (!empty($Address[1]->region)){
            $faktAddress .= $Address[1]->region . ", ";
        }
        if (!empty($Address[1]->province)){
            $faktAddress .= $Address[1]->province . ", ";
        }
        if (!empty($Address[1]->city)){
            $faktAddress .= $Address[1]->city . ", ";
        }
        if (!empty($Address[1]->street)){
            $faktAddress .= $Address[1]->street . ", ";
        }
        if (!empty($Address[1]->home)){
            $faktAddress .= $Address[1]->home . ", ";
        }
        if (!empty($Address[1]->corpus)){
            $faktAddress .= $Address[1]->corpus . ", ";
        }
        if (!empty($Address[1]->apartament)){
            $faktAddress .= $Address[1]->apartament . ", ";
        }


        $legalAddress = substr($legalAddress, 0, strlen($legalAddress) - 2);
        $faktAddress = substr($faktAddress, 0, strlen($faktAddress) - 2);

        $AddressData['legalAddress'] = $legalAddress;
        $AddressData['faktAddress'] = $faktAddress;
        $AddressData['legalAddressDetals'] = $Address[0];
        $AddressData['faktAddressDetals'] = $Address[1];

        return $AddressData;
    }

    private function getCountry() {
        $sql = "SELECT * FROM kode_country";
        $Country = DB::select($sql);
        $data = json_decode(json_encode($Country), true);
        $CountryData = array();

        foreach ($data as $key => $value) {
            $CountryData[$value['id']] = $value['name'];
        }

        return $CountryData;
    }

    private function getKontaktFace($id) {
        $sql = "SELECT * FROM `kontakt_face` WHERE `id_company` = '" . $id . "'";
        $KontaktFacem = DB::select($sql);



        return $KontaktFacem;
    }

    private function getVectorMfCounterparties ($id) {
        $sql = "SELECT users.name as name, counterparties_vertor_mf.`id`, counterparties_vertor_mf.id_vector_mf, counterparties_vertor_mf.`responsible_manager`, users.last_name as last_name, vertor_mf_status.`id` as status, vector_mf.name as vector, counterparties_vertor_mf.amount_sales, counterparties_vertor_mf.amount_mf
FROM `counterparties_vertor_mf`
LEFT JOIN users
  ON users.id = counterparties_vertor_mf.`responsible_manager`
  LEFT JOIN vertor_mf_status
  ON vertor_mf_status.id = counterparties_vertor_mf.`status`
  LEFT JOIN vector_mf
    ON counterparties_vertor_mf.`id_vector_mf` = vector_mf.id
WHERE `id_company` = '" . $id . "'";

        $VectorMfCounterparties = DB::select($sql);

//        $i = 1;
//        while ($cnt3 = $result2->fetch_array()) {
//            $id = $cnt3['id'];
//            $id_vector_mf = $cnt3['id_vector_mf'];
//            $name = $cnt3['name'];
//            $last_name = $cnt3['last_name'];
//            $status = $cnt3['status'];
//            $responsible_manager = $cnt3['responsible_manager'];
//            $vector = $cnt3['vector'];
//            $amount_sales = $cnt3['amount_sales'];
//            $amount_mf = $cnt3['amount_mf'];
//
//            $vertors_sales["vector_" . $i]['id'] = $id;
//            $vertors_sales["vector_" . $i]['id_vector_mf'] = $id_vector_mf;
//            $vertors_sales["vector_" . $i]['name'] = $name;
//            $vertors_sales["vector_" . $i]['last_name'] = $last_name;
//            $vertors_sales["vector_" . $i]['status'] = $status;
//            $vertors_sales["vector_" . $i]['responsible_manager'] = $responsible_manager;
//            $vertors_sales["vector_" . $i]['vector'] = $vector;
//            $vertors_sales["vector_" . $i]['amount_sales'] = $amount_sales;
//            $vertors_sales["vector_" . $i]['amount_mf'] = $amount_mf;
//
//            $i++;
//        }
    }

    public function counterpartiesShow($id)
    {
        $sql = "SELECT counterparties.name,
counterparties.fullname,
counterparties.site,
counterparties.kod_phone, 
counterparties.phone, 
counterparties.id_1c, 
counterparties.fax, 
counterparties.head_company, 
counterparties.email, 
counterparties.status, 
counterparties.vector_mf, 
counterparties.id_parent, 
counterparties.responsible_manager, 
counterparties.inn, 
counterparties.info_fssp, 
counterparties.litigation, 
counterparties.managerment_post, 
counterparties.managerment_name, 
counterparties.need_for_premixes, 
counterparties.consumed_feed,
counterparties.livestock,
counterparties.kpp,
counterparties.type_counterparties,
counterparties.action_company,
counterparties.dont_resident
FROM counterparties " .
            "WHERE counterparties.id = '". $id . "' " .
            "GROUP BY counterparties.id";

        $CounterpartiesInfo = DB::select($sql);








//            $sql = "SELECT b_user.NAME as name, counterparties_vertor_mf.`id`, counterparties_vertor_mf.id_vector_mf, counterparties_vertor_mf.`responsible_manager`, b_user.LAST_NAME as last_name, megacrm_status.`id` as status, megacrm_vector_mf.name as vector, counterparties_vertor_mf.amount_sales, counterparties_vertor_mf.amount_mf
//FROM `counterparties_vertor_mf`
//LEFT JOIN b_user
//  ON b_user.ID = counterparties_vertor_mf.`responsible_manager`
//  LEFT JOIN megacrm_status
//  ON megacrm_status.id = counterparties_vertor_mf.`status`
//  LEFT JOIN megacrm_vector_mf
//    ON counterparties_vertor_mf.`id_vector_mf` = megacrm_vector_mf.id
//WHERE `id_company` = '" . $id . "'";
//
//            $vertors_sales = array();
//
//            if (!$result2 = $mysqli->query($sql)) {
//                echo "error " . $bxapp->error;
//            }
//
//            $i = 1;
//            while ($cnt3 = $result2->fetch_array()) {
//                $id = $cnt3['id'];
//                $id_vector_mf = $cnt3['id_vector_mf'];
//                $name = $cnt3['name'];
//                $last_name = $cnt3['last_name'];
//                $status = $cnt3['status'];
//                $responsible_manager = $cnt3['responsible_manager'];
//                $vector = $cnt3['vector'];
//                $amount_sales = $cnt3['amount_sales'];
//                $amount_mf = $cnt3['amount_mf'];
//
//                $vertors_sales["vector_" . $i]['id'] = $id;
//                $vertors_sales["vector_" . $i]['id_vector_mf'] = $id_vector_mf;
//                $vertors_sales["vector_" . $i]['name'] = $name;
//                $vertors_sales["vector_" . $i]['last_name'] = $last_name;
//                $vertors_sales["vector_" . $i]['status'] = $status;
//                $vertors_sales["vector_" . $i]['responsible_manager'] = $responsible_manager;
//                $vertors_sales["vector_" . $i]['vector'] = $vector;
//                $vertors_sales["vector_" . $i]['amount_sales'] = $amount_sales;
//                $vertors_sales["vector_" . $i]['amount_mf'] = $amount_mf;
//
//                $i++;
//            }

//
//            $sql = "SELECT `megacrm_waypoints`.region,
//                    `megacrm_waypoints`.address,
//                    `megacrm_waypoints`.kontakt_name,
//                    `megacrm_waypoints`.kontakt_phone,
//                    `megacrm_vector_mf`.id
//FROM `megacrm_waypoints`
//  LEFT JOIN megacrm_vector_mf
//    ON megacrm_vector_mf.guid = megacrm_waypoints.`guid_mf`
//WHERE `id_company` = '" . $id . "'";
//
//            $waypoints = array();
//
//            if (!$result2 = $mysqli->query($sql)) {
//                echo "error " . $bxapp->error;
//            }
//
//            $i = 1;
//            while ($cnt3 = $result2->fetch_array()) {
//                $id = $cnt3['id'];
//                $region = $cnt3['region'];
//                $address = $cnt3['address'];
//                $kontakt_name = $cnt3['kontakt_name'];
//                $kontakt_phone = $cnt3['kontakt_phone'];
//
//                $waypoints["vector_" . $i]['id'] = $id;
//                $waypoints["vector_" . $i]['region'] = $region;
//                $waypoints["vector_" . $i]['address'] = $address;
//                $waypoints["vector_" . $i]['kontakt_name'] = $kontakt_name;
//                $waypoints["vector_" . $i]['kontakt_phone'] = $kontakt_phone;
//
//                $i++;
//            }


//
//            $sql = "SELECT * FROM `megacrm_tape_list` WHERE `id_company` = '" . $id . "'";
//
//            $tape_list = array();
//
//            if (!$result2 = $mysqli->query($sql)) {
//                echo "error " . $bxapp->error;
//            }
//
//            $i = 1;
//            while ($cnt3 = $result2->fetch_array()) {
//                $id = $cnt3['id'];
//                $type = $cnt3['type'];
//                $head = $cnt3['head'];
//                $msg = $cnt3['msg'];
//                $date_create = $cnt3['date_create'];
//
//                $tape_list["tape_list_" . $i]['id'] = $id;
//                $tape_list["tape_list_" . $i]['type'] = $type;
//                $tape_list["tape_list_" . $i]['head'] = $head;
//                $tape_list["tape_list_" . $i]['msg'] = $msg;
//                $tape_list["tape_list_" . $i]['date_create'] = $date_create;
//
//                $i++;
//            }


//            $sql = "SELECT `name` FROM `counterparties` WHERE `id` = '" . $cnt['id_parent'] . "'";
//            if (!$result2 = $mysqli->query($sql)) {
//                echo "error " . $mysqli->error;
//            }
//            $cnt2 = $result2->fetch_array();
//
//            $sql = "SELECT `code` FROM `megamix_imap_companies` WHERE `out_id` = '" . $id . "'";
//            if (!$result2 = $bxapp->query($sql)) {
//                echo "error " . $bxapp->error;
//            }
//            $cnt3 = $result2->fetch_array();


//    $data['vertors_fakt_address'] = $vertors_fakt_address;






        $class = new AccessControl;
        return view('Megacrm.cardView')->with([
            'Admin' => $class->Admin(1),
            'CounterpartiesInfo' => $CounterpartiesInfo,
            'Address' => $this->getAddress($id),
            'KontaktFace' => $this->getKontaktFace($id),
            'VectorMfCounterparties' => $this->getVectorMfCounterparties($id),
            'Country' => $this->getCountry()
        ]);
    }

    public function leadsShow($id) {

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
