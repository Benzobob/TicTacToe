<?php
session_start();
?>
<!DOCTYPE html >
<html>
<head>
    <title>Scores</title>
    <link rel="stylesheet" type="text/css" href="styles/tableStyle.css">
    <link rel="stylesheet" type="text/css" href="styles/toolbarStyles.css">
    <script src="http://code.jquery.com/jquery-latest.js"></script>
    <script>
        /*
         * This function is constantly updating the user scores table.
         */
        var cacheData;
        var liveData = $('#dynamic_scores_table').html();
        var auto_refresh = setInterval(
            function()
            {
                $.ajax({
                    url: 'updateScores.php',
                    type: 'POST',
                    dataType: 'html',
                    success: function(liveData){
                        if(liveData !== cacheData) {
                            cacheData = liveData;
                            liveData: liveData;
                            $('#dynamic_scores_table').html(liveData);
                        }}})
            },250);
    </script>
</head>
<body style="background-color: #cddeff">

<div class="topnav">
    <?php
    echo "<a href='dashboard.php?id=" . $_SESSION['id'] . "&uname=" . $_SESSION['uname'] . "'>Dashboard</a>";
    echo "<a href='leaderboard.php?id=" . $_SESSION['id'] . "&uname=" . $_SESSION['uname'] . "'>Leaderboard</a>";
    echo "<a class='active' href='logout.php'> Log out </a>";
    ?>
</div>

<div align="center">
    <h1>Scores for <?php echo $_SESSION['uname']?></h1>
    <div id="dynamic_scores_table">
        <!-- populated with table containing the users statistics retrieved from "updateScores.php"-->
    </div>
</div>
</body>
</html>
