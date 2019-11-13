<?php
try {
$wsdlUrl = 'http://localhost:8080/TTTWebApplication/TTTWebService?WSDL';
$client = new SoapClient($wsdlUrl);
} catch(Exception $e) {
    echo $e->getMessage();
}
?>
