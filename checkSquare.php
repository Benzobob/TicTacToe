<?php
session_start();

include_once 'WebServiceClient.php';
$x = $_REQUEST["x"];
$y = $_REQUEST["y"];
$gid = $_REQUEST["gid"];

$result = $client->checkSquare(array("x" => $x, "y" => $y, "gid" => $gid));
echo $result->return;
?>