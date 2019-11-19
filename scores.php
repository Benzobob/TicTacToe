<?php
session_start();
?>
<!DOCTYPE html >
<html>
<head>
    <title>Scores</title>
    <link rel="stylesheet" type="text/css" href="styles/tableStyle.css">
    <script src="http://code.jquery.com/jquery-latest.js"></script>
    <script>
        //setInterval is a JavaScript method that calls a function or evaluates an expression at specified intervals.
        //We use an anonymous function to define the function called which will check if WebService::showOpenGames has new data.
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
<body>
<div id="test">test
</div>
<div align="center">
    <h1>Scores for <?php echo $_SESSION['uname']?></h1>
    <div id="dynamic_scores_table">
<!--        -->
    </div>
</div>
</body>
</html>
