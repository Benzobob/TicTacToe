<?php session_start();
include_once 'WebServiceClient.php';
$result = $client->leagueTable();

$win = 0;
$lose = 0;
$draw = 0;
$username = "";
$userArray = [];
$array1 = explode("\n", $result->return);

foreach ($array1 as $value) {
    echo "<br>" . $value . "<br>";
    $array2 = explode("," , $value);
    for()
    if($array2[1])
    //$result = $client->getGameState(array("gid" => $array2[0]));

    /*$result = (int) $result->return;
    if($result == 3){
        $draw++;
    }
    else if ($result == 1 && $array2[1]=== $_SESSION['uname']){
        $win++;
    }
    else if($result == 2 && $array2[1]=== $_SESSION['uname']){
        $win++;
    }
    else{
        $lose++;
    } */
}
?>

<!DOCTYPE html >
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" type="text/css" href="tableStyle.css">
</head>
<body>
<div align="center">
    <h1>Leader Board for all Users</h1>
    <table style="width:50%">
        <tr>
            <th>Username</th>
            <th>Win</th>
            <th>Lose</th>
            <th>Draw</th>
        </tr>
        <tr><?php
            echo "<td>" . $username . "</td>";
            echo "<td>" . $win  . "</td>";
            echo "<td>" . $lose . "</td>";
            echo "<td>" . $draw . "</td>";
            ?>
        </tr>
    </table>
</div>
</body>
</html>