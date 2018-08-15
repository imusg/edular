<?php
/**
 * Created by PhpStorm.
 * User: gozhev_m
 * Date: 30.11.2017
 * Time: 10:44
 */

extract($_POST);

$url = "http://172.16.255.159/?CheckUser~^~^000000258~^123456";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
$sid = substr(curl_exec($ch),4, 50);
curl_close($ch);


$from = new DateTime($from);
$to = new DateTime($to);


$url = "http://172.16.255.159/?SaleReport~^" . $sid . "~^" . $guid . "~^" . $from->format("d.m.Y%20H:i:s") . "~^" . $to->format("d.m.Y%20H:i:s") . "";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_HEADER, FALSE);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
$data = curl_exec($ch);
curl_close($ch);

echo "<html><head>
    <script src=\"//code.jquery.com/jquery-3.2.1.min.js\"></script>
    <script type=\"text/javascript\">
        window.onload = function () {


            var sub = 0;
            $(\".sub\").click(function() {
                if (sub == 0) {
                    $(\".child_\" + $(this).attr(\"group\")).hide();
                    sub=1;
                } else if (sub == 1) {
                    $(\".child_\" + $(this).attr(\"group\")).show();
                    sub=0;
                }
            });




            var subsub = 0;
            $(\".subsub\").click(function() {
                if (subsub == 0) {
                    $(\".subchild_\" + $(this).attr(\"subgroup\")).hide();
                    subsub=1;
                } else if (subsub == 1) {
                    $(\".subchild_\" + $(this).attr(\"subgroup\")).show();
                    subsub=0;
                }
            });


            var subsubsub = 0;
            $(\".subsubsub\").click(function() {
                if (subsubsub == 0) {
                    $(\".subsubchild_\" + $(this).attr(\"subsubgroup\")).hide();
                    subsubsub=1;
                } else if (subsubsub == 1) {
                    $(\".subsubchild_\" + $(this).attr(\"subsubgroup\")).show();
                    subsubsub=0;
                }
            });



            var subsubsubsub = 0;
            $(\".subsubsubsub\").click(function() {
                if (subsubsubsub == 0) {
                    $(\".subsubsubchild_\" + $(this).attr(\"subsubsubgroup\")).hide();
                    subsubsubsub=1;
                } else if (subsubsubsub == 1) {
                    $(\".subsubsubchild_\" + $(this).attr(\"subsubsubgroup\")).show();
                    subsubsubsub=0;
                }
            });


        }
    </script>

</head><body>";

$data = "@body@
@level=1;group=1;@~^Название 1~^Название 2~^Название 3~^Название 4~^~^
@group=1;@~^Ячейка 1~^Ячейка 1~^Ячейка 1~^Ячейка 1~^~^
@group=1;@~^Ячейка 1~^Ячейка 1~^Ячейка 1~^Ячейка 1~^~^
@group=1;@~^Ячейка 1~^Ячейка 1~^Ячейка 1~^Ячейка 1~^~^
@group=1;@~^Ячейка 1~^Ячейка 1~^Ячейка 1~^Ячейка 1~^~^
@level=2;group=2;@~^Название 1~^Название 2~^Название 3~^Название 4~^~^
@group=2;@~^Ячейка 1~^Ячейка 1~^Ячейка 1~^Ячейка 1~^~^
@group=2;@~^Ячейка 1~^Ячейка 1~^Ячейка 1~^Ячейка 1~^~^
@group=2;@~^Ячейка 1~^Ячейка 1~^Ячейка 1~^Ячейка 1~^~^
@group=2;@~^Ячейка 1~^Ячейка 1~^Ячейка 1~^Ячейка 1~^~^
@level=2;group=3;@~^Название 1~^Название 2~^Название 3~^Название 4~^~^
@group=3;@~^Ячейка 1~^Ячейка 1~^Ячейка 1~^Ячейка 1~^~^
@group=3;@~^Ячейка 1~^Ячейка 1~^Ячейка 1~^Ячейка 1~^~^
@group=3;@~^Ячейка 1~^Ячейка 1~^Ячейка 1~^Ячейка 1~^~^
@group=3;@~^Ячейка 1~^Ячейка 1~^Ячейка 1~^Ячейка 1~^~^
@level=3;group=4;@~^Название 1~^Название 2~^Название 3~^Название 4~^~^
@group=4;@~^Ячейка 1~^Ячейка 1~^Ячейка 1~^Ячейка 1~^~^
@group=4;@~^Ячейка 1~^Ячейка 1~^Ячейка 1~^Ячейка 1~^~^
@group=4;@~^Ячейка 1~^Ячейка 1~^Ячейка 1~^Ячейка 1~^~^
@group=4;@~^Ячейка 1~^Ячейка 1~^Ячейка 1~^Ячейка 1~^~^";

if ($data != "SaleReport") {

    $body_pos = strpos($data, "@body@");
    $data = substr($data, $body_pos + 6, strlen($data) - $body_pos);


    $data = explode("~^~^", $data);

    $report = "<table class=\"table table-bordered\" style=\"border-color: #000000\">";



    for ($i=0; $i < count($data); $i++) {
        $param_pos = strpos($data[$i], "@~^");
        $tr = substr($data[$i], 1, $param_pos - 1);
        $tr = str_replace("@", "", $tr);
        $tr = explode(";", $tr);
        // print_r($tr);

        $pos = strpos($tr[0], "level");
        if ($pos === false) {
            $group = substr($tr[0], strlen($tr[0]) - 1,1);
            if ($group == 1) {
                $report_data = "<tr class=\"child_1\"><td class=\"no_border\"></td>";
            } else if ($group == 2) {
                $report_data = "<tr class=\"child_1 subchild_1\"><td class=\"no_border\"></td>";
            } else if ($group == 3) {
                $report_data = "<tr class=\"child_1 subchild_1 subchild_2\"><td class=\"no_border\"></td>";
            } else if ($group == 4) {
                $report_data = "<tr class=\"child_1 subchild_1 subchild_2 subchild_3\"><td class=\"no_border\"></td>";
            } else if ($group == 5) {
                $report_data = "<tr class=\"child_1 subchild_1 subchild_2 subchild_3 subchild_4\"><td class=\"no_border\"></td>";
            } else if ($group == 6) {
                $report_data = "<tr class=\"child_1 subchild_1 subchild_2 subchild_3 subchild_4 subchild_5\"><td class=\"no_border\"></td>";
            }
        } else {
            $level = substr($tr[0], strlen($tr[0]) - 1,1);
            if ($level == 1) {
                $report_data .= "<tr><td class=\"no_border\"><button class=\"sub\" " . $tr[1] . ">123</button></td>";
            } else if ($level == 2) {
                $report_data .= "<tr class=\"child_1\"><td class=\"no_border\"><button class=\"subsub\" sub" . $tr[1] . ">123</button></td>";
            } else if ($level == 3) {
                $report_data .= "<tr class=\"child_1 subchild_1\"><td class=\"no_border\"><button class=\"subsubsub\" subsub" . $tr[1] . ">123</button></td>";
            } else if ($level == 4) {
                $report_data .= "<tr class=\"child_1 subchild_1 subchild_2\"><td class=\"no_border\"><button class=\"subsubsubsub\" subsubsub" . $tr[1] . ">123</button></td>";
            } else if ($level == 5) {
                $report_data .= "<tr class=\"child_1 subchild_1 subchild_2 subchild_3\"><td class=\"no_border\"><button class=\"subsubsubsubsub\" subsubsubsub" . $tr[1] . ">123</button></td>";
            } else if ($level == 6) {
                $report_data .= "<tr class=\"child_1 subchild_1 subchild_2 subchild_3 subchild_4\"><td class=\"no_border\"><button class=\"subsubsubsubsubsub\" subsubsubsubsub" . $tr[1] . ">123</button></td>";
            }
        }


        $data[$i] = substr($data[$i], $param_pos + 3, strlen($data[$i]));
        $row = explode("~^", $data[$i]);


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

    echo "</body></html>";
} else {
    $data = explode("~^~^", $data);

    $report = "<table class=\"table\"><tr><td>Нет данных</td></tr>";

    $report .= "</table>";
    echo $report;
}


?>