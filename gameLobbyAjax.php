<?php
include_once 'WebServiceClient.php';

$result = $client->showOpenGames();
$results = explode("\n", $result->return);

echo <<<'EOD'
<table style="width:25%">
    <tr>
        <th>Game id</th>
        <th>Opponent</th>
        <th>Join Game</th>
    </tr>
EOD;

foreach ($results as $singleOpenGame) {
    $doubleExplosionMayham = explode(",", $singleOpenGame);
    echo "<tr><td>" . $doubleExplosionMayham[0] . "</td><td>" . $doubleExplosionMayham[1] . "</td><td><form method='post' action='gameboard.php'><input type='hidden' name='gameid' value='" . $doubleExplosionMayham[0] . "'><input type='submit'value='JOIN'></form>";
}

?>
