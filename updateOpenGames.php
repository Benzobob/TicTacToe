<?php
session_start();
include_once 'WebServiceClient.php';

//Store result of showOpenGames in result
$result = $client->showOpenGames();
//Explode result by new line character
$results = explode("\n", $result->return);

//Echo table headers
echo <<<'EOD'
<table style="width:25%">
    <tr>
        <th>Game id</th>
        <th>Opponent</th>
        <th>Join Game</th>
    </tr>
EOD;

//Cycle through results, echoing a row for each open game
foreach ($results as $singleOpenGame) {
    $doubleExplosionMayham = explode(",", $singleOpenGame);
    echo "<tr><td>" . $doubleExplosionMayham[0] . "</td><td>" . $doubleExplosionMayham[1] . "</td><td><form method='post' action='joinGame.php'><input type='hidden' name='gameid' value='" . $doubleExplosionMayham[0] . "'><input type='submit'value='JOIN'></form>";
}

?>
