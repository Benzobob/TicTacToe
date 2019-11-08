<?php
$wsdlUrl = 'http://localhost:8080/TTTWebApplication/TTTWebService?WSDL';
$client = new SoapClient($wsdlUrl);

$types = $client->__getTypes();
$functions = $client->__getFunctions ();
//print_r($types);

$result = $client->newGame(array("uid" => "1"));
$result->return;
//echo "\n";
//echo $functions;
//$result->return;
?>
