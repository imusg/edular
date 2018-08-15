<?php
/**
 * Created by PhpStorm.
 * User: gozhev_m
 * Date: 30.11.2017
 * Time: 10:44
 */

extract($_POST);

$url = "http://172.16.255.159/?CheckUser~^~^000000258~^123123";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
$sid = substr(curl_exec($ch),4, 50);
curl_close($ch);


$from = new DateTime($from);
$to = new DateTime($to);


$url = "http://172.16.255.159/?SaleRecept~^" . $sid . "~^" . $guid . "~^";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_HEADER, FALSE);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
$data = curl_exec($ch);
curl_close($ch);

if ($data != "SaleRecept") {
    $data = explode("~^~^", $data);

    $report = "<table class=\"table table-bordered\" style=\"border-color: #000000\">";

    for ($i=0; $i < count($data); $i++) {
        $row = explode("~^", $data[$i]);

        $report .= "<tr>";
        $report_data = "";
        if ($y == 0) {
            for ($y=0; $y < count($row); $y++) {
                $report_data .= "<th scope=\"col\">" . $row[$y] . "</th>";
            }
        } else {
            for ($y=0; $y < count($row); $y++) {
                $report_data .= "<td>" . $row[$y] . "</td>";
            }
        }
        $report .= $report_data . "</tr>";
    }

    $report .= "</table>";
    echo $report;
} else {
    $data = explode("~^~^", $data);
    $report = "<table class=\"table\"><tr><td>Нет данных</td></tr>";
    $report .= "</table>";
    echo $report;
}


?>