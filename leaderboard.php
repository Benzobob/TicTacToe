<?php
session_start();
?>
<!DOCTYPE html >
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" type="text/css" href="styles/toolbarStyles.css">
    <link rel="stylesheet" type="text/css" href="styles/tableStyle.css">
    <script src="http://code.jquery.com/jquery-latest.js"></script>
    <script>

        /*
         * This function is constantly updating the Leader board table.
         */
        var cacheData;
        var liveData = $('#dynamic_leaderboard').html();
        var auto_refresh = setInterval(
            function()
            {
                $.ajax({
                    url: 'updateLeaderboard.php',
                    type: 'POST',
                    dataType: 'html',
                    success: function(liveData){
                        if(liveData !== cacheData) {
                            cacheData = liveData;
                            liveData: liveData;
                            $('#dynamic_leaderboard').html(liveData);
                        }}})
            },250);
    </script>
</head>
<body style="background-color: #cddeff">
<div class="topnav">
    <?php
    echo "<a href='dashboard.php?id=" . $_SESSION['id'] . "&uname=" . $_SESSION['uname'] . "'>Dashboard</a>";
    echo "<a href='scores.php?id=" . $_SESSION['id'] . "&uname=" . $_SESSION['uname'] . "'>Statistics</a>";
    echo "<a class='active' href='logout.php'> Log out </a>";
    ?>
</div>

<div align="center">
    <h1>Leader Board for all Users</h1>
    <div id="dynamic_leaderboard">
        <!-- populated with table retrieved from "updateLeaderboard.php"-->
    </div>
</div>
</body>
</html>