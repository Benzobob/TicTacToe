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
        if ($pid === (int) $array2[0]){
            $flag = 0;
        }
        else $flag = 1;
    }
}
elseif($results[0] === "ERROR-NOMOVES"){
    $flag = 3;
}
echo $flag;