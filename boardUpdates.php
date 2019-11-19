<?php
session_start();
include_once 'WebServiceClient.php';

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
            $_SESSION['moves'][$x][$y] = 1;
        } //Print an x at these co-ordinates
        else{
            $x = $array2[1];
            $y = $array2[2];
            $_SESSION['moves'][$x][$y] = 2;
        }
    }

    foreach ($_SESSION['moves'] as $vals){
        echo "<tr><td class='h v'>".$vals[0]."</td><td class='h v'>".$vals[1]."</td><td class='h v'>".$vals[2]."</td></tr>";
    }
    echo "</table></div>";

}
else {
    echo "Game has not started yet";
}



?>