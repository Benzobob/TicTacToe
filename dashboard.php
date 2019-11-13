<?php session_start(); ?>
<!DOCTYPE html >
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div align="center">
    <h1>Dashboard</h1>
    <?php
        echo "<button><a href='scores.php?id=" . $_SESSION['id'] . "'> Scores</a></button><td>";
        echo "<button><a href='board.php'> Leader Board</a></button>";
        echo "<button><a href='game.php'> New Game</a></button>";
    ?>
</div>
<div align="center">
    <h3>Table of available games</h3>
    <table>
        <tr>
            <p>Game 1</p>
        </tr>
        <tr>
            <p>Game 2</p>
        </tr>
    </table>
</div>
</body>
</html>