<?php session_start();
//needed to populate table of open games. Will likely need to be moved into thread.
include_once 'WebServiceClient.php';
unset($_SESSION['gameid']);
unset($_SESSION['moves']);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" type="text/css" href="styles/tableStyle.css">
    <link rel="stylesheet" type="text/css" href="styles/toolbarStyles.css">
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

<div class="topnav">
    <?php
    echo "<a href='leaderboard.php?id=" . $_SESSION['id'] . "&uname=" . $_SESSION['uname'] . "'>Leaderboard</a>";
    echo "<a href='scores.php?id=" . $_SESSION['id'] . "&uname=" . $_SESSION['uname'] . "'>Statistics</a>";
    echo "<a class='active' href='logout.php'> Log out </a>";
    ?>
</div>


<div align="center">
    <h1>Dashboard</h1>
    <?php
    echo "<a href='newGame.php'> <img src=\"imgs/play-btn.png\" width=\"200\" height=\"100\"></a>";
    ?>
</div>
<div align="center">
    <div id="dynamic_lobby">
<!--        populated with table of open games via ajax and gameLobbyAjax.php, php file declared line 18-->
    </div>
</div>
</body>
</html>
