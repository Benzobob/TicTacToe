<?php session_start();
//needed to populate table of open games. Will likely need to be moved into thread.
include_once 'WebServiceClient.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" type="text/css" href="styles/tableStyle.css">
    <script src="http://code.jquery.com/jquery-latest.js"></script>
    <script>
        var cacheData;
        var liveData = $('#dynamic_lobby').html();
        var auto_refresh = setInterval(
            function()
            {
                $.ajax({
                    url: 'gameLobbyAjax.php',
                    type: 'POST',
                    dataType: 'html',
                    success: function(liveData){
                        if(liveData !== cacheData) {
                            cacheData = liveData;
                            liveData: liveData;
                            $('#dynamic_lobby').html(liveData);
                        }}})
            },250);
    </script>
</head>
<body>
<div align="center">
    <h1>Dashboard</h1>
    <?php
    echo "<button><a href='scores.php?id=" . $_SESSION['id'] . '&uname=' . $_SESSION['uname'] . "'> Scores</a></button><td>";
    echo "<button><a href='leaderboard.php?id=" . $_SESSION['id'] . '&uname=' . $_SESSION['uname'] . "'> Leader Board</a></button>";
    echo "<button><a href='gameboard.php'> New Game</a></button>";
    ?>
</div>
<div align="center">
    <h3>Table of available games</h3>
    <div id="dynamic_lobby">
<!--        populated with games via ajax and gameLobbyAjax.php-->
    </div>
</div>
</body>
</html>
