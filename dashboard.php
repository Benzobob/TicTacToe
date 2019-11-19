<?php session_start();
//needed to populate table of open games. Will likely need to be moved into thread.
include_once 'WebServiceClient.php';
unset($_SESSION['gameid']);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" type="text/css" href="styles/tableStyle.css">
    <script src="http://code.jquery.com/jquery-latest.js"></script>
    <script>
        //setInterval is a JavaScript method that calls a function or evaluates an expression at specified intervals.
        //We use an anonymous function to define the function called which will check if WebService::showOpenGames has new data.
        var cacheData;
        var liveData = $('#dynamic_lobby').html();
        var auto_refresh = setInterval(
            function()
            {
                $.ajax({
                    url: 'updateOpenGames.php',
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
    echo "<button><a href='gameboard.php?'> New Game</a></button>";
    ?>
</div>
<div align="center">
    <h3>Table of available games</h3>
    <div id="dynamic_lobby">
<!--        populated with table of open games via ajax and gameLobbyAjax.php, php file declared line 18-->
    </div>
</div>
</body>
</html>
