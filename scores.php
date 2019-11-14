<?php session_start();
include_once 'WebServiceClient.php';
$result = $client->showAllMyGames(array("uid" => $_SESSION['id']));

$win = 0;
$lose = 0;
$draw = 0;

$array1 = explode("\n", $result->return);

foreach ($array1 as $value) {
    $array2 = explode("," , $value);
    $result = $client->getGameState(array("gid" => $array2[0]));

    $result = (int) $result->return;
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
    }
}
?>

<!DOCTYPE html >
<html>
<head>
    <title>Scores</title>
    <link rel="stylesheet" type="text/css" href="styles/tableStyle.css">
</head>
<body>
<div align="center">
    <h1>Scores for <?php echo $_SESSION['uname']?></h1>
    <table style="width:50%">
        <tr>
            <th>Win</th>
            <th>Lose</th>
            <th>Draw</th>
        </tr>
        <tr><?php
            echo "<td>" . $win  . "</td>";
            echo "<td>" . $lose . "</td>";
            echo "<td>" . $draw . "</td>";
            ?>
        </tr>
    </table>
</div>
</body>
</html>
