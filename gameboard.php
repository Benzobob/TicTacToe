<?php
session_start();
include_once 'WebServiceClient.php';
if (!empty($_POST["gameid"])) {
    $gameid = (int)$_POST["gameid"];
    $result = $client->joinGame(array("uid" => $_SESSION['id'], "gid" => $gameid));
    switch ($result->return) {
        case "ERROR-DB":
            echo "There has been an error: ERROR-DB";
            break;
        case "1":
            echo "Joined";
            break;
        default:
            echo "Unable to join";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Gameboard</title>
    <link rel="stylesheet" type="text/css" href="tableStyle.css">
</head>
<body>


</body>
</html>