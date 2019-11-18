<?php
session_start();

include_once 'WebServiceClient.php';
$x = $_REQUEST["x"];
$y = $_REQUEST["y"];
$gid = $_REQUEST["gid"];
$pid = $_REQUEST["pid"];

$result = $client->takeSquare(array("x" => $x, "y" => $y, "gid" => $gid, "pid" => $pid));
echo $result->return;
?>
