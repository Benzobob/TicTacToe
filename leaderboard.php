


<!DOCTYPE html >
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" type="text/css" href="styles/tableStyle.css">
    <script src="http://code.jquery.com/jquery-latest.js"></script>
    <script>

        //setInterval is a JavaScript method that calls a function or evaluates an expression at specified intervals.
        //We use an anonymous function to define the function called which will check if WebService::showOpenGames has new data.
        var cacheData;
        var liveData = $('#dynamic_leaderboard').html();
        var auto_refresh = setInterval(
            function()
            {
                $.ajax({
                    url: 'leaderboardAjax.php',
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
<body>
<div align="center">
    <h1>Leader Board for all Users</h1>
    <div id="dynamic_leaderboard">
        <!--        populated with table of leaderboard details via ajax and leaderboardAjax.php -->
    </div>

</div>
</body>
</html>