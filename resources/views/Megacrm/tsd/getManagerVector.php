<?php
/**
 * Created by PhpStorm.
 * User: gozhev_m
 * Date: 30.07.2018
 * Time: 16:18
 */

extract($_POST);

require_once('../config.php');

$mysqli = new mysqli($host, $login, $passwd, $db);

$mysqli->query("set names utf8;");

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


$url = "http://172.16.255.159/?getManagerVector~^" . $sid . "~^" . $login;
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_HEADER, FALSE);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
$data = curl_exec($ch);
curl_close($ch);

if ($data != "getManagerVector") {

$sql = "";

}


$mysqli->close();

?>