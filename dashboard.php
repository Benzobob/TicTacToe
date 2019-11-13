<?php session_start(); ?>
<!DOCTYPE html >
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" type="text/css" href="tableStyle.css">
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
    <table style="width:15%">
        <tr>
            <td>Game 1</td>
        </tr>
        <tr>
            <td>Game 2</td>
        </tr>
    </table>
</div>
</body>
</html>