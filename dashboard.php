<?php session_start();

//needed to populate table of open games. Will likely need to be moved into thread.
include_once 'WebServiceClient.php';
$result = $client->showOpenGames();
$results = explode("\n", $result->return);
//
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" type="text/css" href="styles/tableStyle.css">
</head>
<body>
<div align="center">
    <h1>Dashboard</h1>
    <?php
        echo "<button><a href='scores.php?id=" . $_SESSION['id'] . '&uname=' . $_SESSION['uname'] . "'> Scores</a></button><td>";
        echo "<button><a href='leaderboard.php?id=" . $_SESSION['id'] . '&uname=' . $_SESSION['uname'] . "'> Leader Board</a></button>";
        echo "<button><a href='newGame.php'> New Game</a></button>";
    ?>
</div>
<div align="center">
    <h3>Table of available games</h3>
    <table style="width:25%">
        <tr>
            <th>Game id</th>
            <th>Opponent</th>
            <th>Join Game</th>
        </tr>

            <?php
            foreach ($results as $singleOpenGame) {
                $doubleExplosionMayham = explode(",", $singleOpenGame);
                echo "<tr><td>" . $doubleExplosionMayham[0] . "</td><td>" . $doubleExplosionMayham[1] . "</td><td><form method='post' action='gameboard.php'><input type='hidden' name='gameid' value='" . $doubleExplosionMayham[0] . "'><input type='submit'value='JOIN'></form>";
            }
            ?>

    </table>
</div>
</body>
</html>