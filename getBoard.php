<?php
session_start();
include_once 'WebServiceClient.php';

$c1 = 0;
$c2 = 1;
$c3 = 2;
$pid = $_SESSION['id'];
$gid = $_SESSION['gameid'];
$result = $client->getBoard(array("gid" => $gid));
$results = explode("\n", $result->return);

if(!($results[0] === "ERROR-NOMOVES")) {
    foreach ($results as $value) {
        $array2 = explode(",", $value);
        if ($pid === (int)$array2[0]) {
            $x = $array2[1];
            $y = $array2[2];
            $_SESSION['moves'][$x][$y] = "imgs/x.png";
        } //Print an x at these co-ordinates
        else{
            $x = $array2[1];
            $y = $array2[2];
            $_SESSION['moves'][$x][$y] = "imgs/o.png";
        }
    }

    echo "<table id=\"grid\">";
    foreach ($_SESSION['moves'] as $vals){
        echo "<tr><td class='v h' id='" . $c1 . "'><img src='" . $vals[0] . "'></td><td class='v h' id='". $c2 ."'><img src='" . $vals[1] . "'></td><td class='v h' id='". $c3 ."'><img src='" . $vals[2] . "'></td></tr>";
        $c1 = $c1+3;
        $c2 = $c2+3;
        $c3 = $c3+3;
    }
    echo "</table>";
}
else {
    echo "<table id=\"grid\">";
    foreach ($_SESSION['moves'] as $vals){
        echo "<tr><td class='v h' id='" . $c1 . "'><img src='" . $vals[0] . "'></td><td class='v h' id='". $c2 ."'><img src='" . $vals[1] . "'></td><td class='v h' id='". $c3 ."'><img src='" . $vals[2] . "'></td></tr>";
        $c1 = $c1+3;
        $c2 = $c2+3;
        $c3 = $c3+3;
    }
    echo "</table>";
}


?>