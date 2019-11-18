<?php
session_start();

include_once 'WebServiceClient.php';
$gid = $_REQUEST["gid"];

$result = $client->getBoard(array("gid" => $gid));
echo $result->return;
?>