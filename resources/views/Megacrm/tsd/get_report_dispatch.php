<?php
/**
 * Created by PhpStorm.
 * User: gozhev_m
 * Date: 08.05.2018
 * Time: 11:37
 */

extract($_POST);

require_once('../config.php');



$id = "7";

if ($id == $id_report) {
    $mysqli = new mysqli($host, $login, $passwd, $db);

    $mysqli->query("set names utf8;");

    $sql = "SELECT checked FROM megacrm_report_access WHERE id_user = '" . $id_user . "' and id_report = '" . $id_report . "'";
    $result = $mysqli->query($sql);

    $cnt = $result->fetch_assoc();
    $checked = $cnt['checked'];
    if (strlen($checked) <= 0) {
        $sql = "SELECT id FROM megacrm_user_groups WHERE id_user = '" . $id_user . "'";
        $result = $mysqli->query($sql);
        $cnt = $result->fetch_assoc();

        $sql = "SELECT checked FROM megacrm_report_access WHERE id_group = '" . $id_user . "' and id_report = '" . $id_report . "'";
        $result = $mysqli->query($sql);
        $cnt = $result->fetch_assoc();
        $checked = $cnt['checked'];


        if (strlen($checked) <= 0) {
            echo "Нет доступа к отчету";
        } else if ($checked == 0) {
            echo "Нет доступа к отчету";
        } else if ($checked == 1) {


            $from = "03.04.2018";
            $to = "17.05.2018";

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


            $url = "http://172.16.255.159/?getReportDispatch~^" . $sid;
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_HEADER, FALSE);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            $data = curl_exec($ch);
            curl_close($ch);

            if ($data != "getReportDispatch") {


                $script = "<script src=\"//code.jquery.com/jquery-3.2.1.min.js\"></script>
    <script src=\"//bxapp.megamix.ru/Megacrm/js/report_system.js\"></script>
    <script src=\"/Megacrm/js/jquery-ui.min.js\"></script>
    <script type='text/javascript'>
    
    
</script> ";

                $pos = strpos($data, "</TITLE>");
                $data = substr($data, 0, $pos + 8) . $script . substr($data, $pos + 8, strlen($data));

                $name = md5(rand());
                $fl = fopen("/var/www/html/Megacrm/reports_files/" . $name . ".html", "w+");
                fwrite($fl, $data);
                fclose($fl);

                echo $name;
            }
        }

    } else if ($checked == 0) {
        echo "Нет доступа к отчету";
    } else if ($checked == 1) {
        $from = "03.04.2018";
        $to = "17.05.2018";

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


        $url = "http://172.16.255.159/?getReportDispatch~^" . $sid;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        $data = curl_exec($ch);
        curl_close($ch);

        if ($data != "getReportDispatch") {


            $script = "<script src=\"//code.jquery.com/jquery-3.2.1.min.js\"></script>
    <script src=\"//bxapp.megamix.ru/Megacrm/js/report_system.js\"></script>
    <script src=\"/Megacrm/js/jquery-ui.min.js\"></script>
    <script type='text/javascript'>
    
    
</script> ";

            $pos = strpos($data, "</TITLE>");
            $data = substr($data, 0, $pos + 8) . $script . substr($data, $pos + 8, strlen($data));

            $name = md5(rand());
            $fl = fopen("/var/www/html/Megacrm/reports_files/" . $name . ".html", "w+");
            fwrite($fl, $data);
            fclose($fl);

            echo $name;
        }
    }

    $mysqli->close();
}



?>