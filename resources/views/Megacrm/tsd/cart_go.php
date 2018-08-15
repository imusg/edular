<?php
/**
 * Created by PhpStorm.
 * User: gozhev_m
 * Date: 28.05.2018
 * Time: 14:24
 */

extract($_POST);

require_once('../config.php');

$mysqli = new mysqli($host, $login, $passwd, $db);
$mysqli->query("set names utf8");

$ship_date = new DateTime($ship_date);


$sql = "SELECT `id_1c` FROM megacrm_company WHERE id = '" . $id_company . "'";
$result = $mysqli->query($sql);

if (!$result = $mysqli->query($sql)) {
    echo "error " . $mysqli->error;
}
$cnt = $result->fetch_assoc();
$guid = $cnt['id_1c'];

$sql = "UPDATE `megacrm_orders` SET `ship_date` = '" . $ship_date->format("d.m.Y H:i:s") . "', `ship_place` = '" . $ship_place . "', `company_ship` = 'ООО Мегамикс', `guid_company` = '" . $guid . "' WHERE `id_user` = '" . $user_id . "' and `id_company` = '" . $id_company . "'";
if (!$result = $mysqli->query($sql)) {
    echo "error " . $mysqli->error;
}

$sql = "UPDATE `megacrm_cart` SET `status` = '1' WHERE `id_user` = '" . $user_id . "' and `id_company` = '" . $id_company . "' and end = '0'";
if (!$result = $mysqli->query($sql)) {
    echo "error " . $mysqli->error;
}

$sql = "SELECT `id` FROM megacrm_cart WHERE id_company = '" . $id_company . "' and id_user = '" . $user_id . "' and end = '0'";
if (!$result = $mysqli->query($sql)) {
    echo "error " . $mysqli->error;
}

$cnt = $result->fetch_assoc();
$id_cart = $cnt['id'];




$sql = "SELECT COUNT(*) as cnt FROM megacrm_orders WHERE id_cart = '" . $id_cart . "'";
$result = $mysqli->query($sql);

if (!$result = $mysqli->query($sql)) {
    echo "error " . $mysqli->error;
}
$cnt = $result->fetch_assoc();
$cnt_orders = $cnt['cnt'];

if ($cnt_orders > 0) {
    $url = "http://172.16.255.159/?CheckUser~^~^000000258~^123123";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    $sid = substr(curl_exec($ch),4, 50);
    curl_close($ch);


    $url = "http://172.16.255.159/?sendCart~^" . $sid . "~^" . $id_cart;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HEADER, FALSE);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    echo $data = curl_exec($ch);
    curl_close($ch);


    if ($data == "OK") {
        $sql = "UPDATE `megacrm_cart` SET `status` = '2', end = '1' WHERE `id_user` = '" . $user_id . "' and `id_company` = '" . $id_company . "'";
        if (!$result = $mysqli->query($sql)) {
            echo "error " . $mysqli->error;
        }
    }
} else {
    echo "ER_empty_php";
}




$mysqli->close();
?>