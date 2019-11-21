<?php
session_start();
include_once 'WebServiceClient.php';

//Store result of showOpenGames in result
$result = $client->showOpenGames();
//Explode result by new line character
$results = explode("\n", $result->return);



//Cycle through results, echoing a row for each open game
if($results[0] === "ERROR-NOGAMES"){
    echo "<h2>No available games yet.</h2>";
}
else {
    //Echo table headers
    echo <<<'EOD'
<h3>Table of available games</h3>
<table style="width:25%">
    <tr>
        <th>Game id</th>
        <th>Opponent</th>
        <th>Join Game</th>
    </tr>
EOD;

    $results = array_reverse($results);
    foreach ($results as $singleOpenGame) {
        $array1 = explode(",",$singleOpenGame);
        if($array1[1] !== $_SESSION['uname']) {
            $doubleExplosionMayham = explode(",", $singleOpenGame);
            echo "<tr><td>" . $doubleExplosionMayham[0] . "</td><td>" . $doubleExplosionMayham[1] . "</td><td><form method='post' action='joinGame.php'><input type='hidden' name='gameid' value='" . $doubleExplosionMayham[0] . "'><input type=\"image\" src=\"imgs/join.png\" width=\"50\" height=\"50\"></form>";
        }
    }
}

?>
