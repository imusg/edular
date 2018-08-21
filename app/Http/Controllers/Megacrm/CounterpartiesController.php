<?php

namespace App\Http\Controllers\Megacrm;

use App\Counterparties;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Library\AccessControl;

class CounterpartiesController extends Controller
{
    private function getManagerVector ($login) {
        $url = "http://172.16.255.159/?CheckUser~^~^000000258~^123123";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        $sid = substr(curl_exec($ch),4, 50);
        curl_close($ch);

        $url = "http://172.16.255.159/?getManagerVector~^" . $sid . "~^" . $login;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        $data = curl_exec($ch);
        curl_close($ch);

        if ($data != "getManagerVector") {
            return $data;
        }

    }

    /**
     * @param $page
     * @return $this
     */
    public function show($page)
    {
        $login = $this->getManagerVector("gozhev.m");

        $page = $page - 1;
        $limit = ",50";
        $limit = ($page * 50) . $limit;

        $qry = "SELECT COUNT(*) as count FROM `counterparties`
LEFT JOIN counterparties_vertor_mf
  ON counterparties_vertor_mf.id_company = counterparties.id
LEFT JOIN vector_mf
  ON vector_mf.id = counterparties_vertor_mf.id_vector_mf
WHERE vector_mf.guid = '" . $login . "' and counterparties.type_company = '2'";
        $CounterpartiesCount = DB::select($qry);
        $CounterpartiesCount = $CounterpartiesCount[0]->count / 50;


        $sql = "SELECT `counterparties`.*
FROM `counterparties`
LEFT JOIN counterparties_vertor_mf
  ON counterparties_vertor_mf.id_company = counterparties.id
LEFT JOIN vector_mf
  ON vector_mf.id = counterparties_vertor_mf.id_vector_mf
WHERE vector_mf.guid = '" . $login . "' and counterparties.type_company = '2' LIMIT " . $limit;
        $Counterparties = DB::select($sql);

        $class = new AccessControl;
        return view('Megacrm.counterparties.list')->with([
            'Admin' => $class->Admin(1),
            'Counterparties' => $Counterparties,
            'CounterpartiesCount' => $CounterpartiesCount
        ]);
    }
}
