<?php
session_start();

//Call takeSquare WS method and echo the result.
include_once 'WebServiceClient.php';
$x = $_REQUEST["x"];
$y = $_REQUEST["y"];
$gid = $_SESSION["gameid"];
$pid = $_SESSION["id"];

$result = $client->takeSquare(array("x" => $x, "y" => $y, "gid" => $gid, "pid" => $pid));
echo $result->return;
?>
