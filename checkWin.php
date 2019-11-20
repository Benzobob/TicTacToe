<?php
session_start();

include_once 'WebServiceClient.php';
$gid = $_SESSION["gameid"];


$result = $client->checkWin(array("gid" => $gid));
echo $result->return;
?>