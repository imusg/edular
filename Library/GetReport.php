<?php
/**
 * Created by PhpStorm.
 * User: gozhev_m
 * Date: 16.08.2018
 * Time: 8:46
 */

namespace Library;


class GetReport
{
    private function getReportData ($name, $user_id = 0, $start = "00.00.0000 00:00", $end = "00.00.0000 00:00") {
        $url = "http://172.16.255.159/?CheckUser~^~^000000258~^123123";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        $sid = substr(curl_exec($ch),4, 50);
        curl_close($ch);



        $url = "http://172.16.255.159/?$name~^" . $sid . "~^" . $from->format($start) . "~^" . $to->format($end) . "~^" . $login;


        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        $data = curl_exec($ch);
        curl_close($ch);
    }

    public function getAccess($user_id, $report_id) {
        DB::select("SELECT ");


        if ($access) {

        }
    }

}