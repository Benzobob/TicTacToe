<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Game Board</title>
</head>
<body>

<div class="topnav">
    <?php 
    echo "<a href='dashboard.php?id=" . $_SESSION['id'] . "&uname=" . $_SESSION['uname'] . "'>Dashboard</a>";
    echo "<a href='leaderboard.php?id=" . $_SESSION['id'] . "&uname=" . $_SESSION['uname'] . "'>Leaderboard</a>";
    echo "<a href='scores.php?id=" . $_SESSION['id'] . "&uname=" . $_SESSION['uname'] . "'>Statistics</a>";
    echo "<a class='active' href='logout.php'> Log out </a>";
    ?>
</div>
<div align="center" id="Title">
    <h2>Game Board</h2>
    <h4 id="turns"></h4>
    <p id="countdown"></p>
</div>
<div id="go" align="center"></div>

<br>
<div align="center" id="board">
</div>

<link rel="stylesheet" type="text/css" href="styles/boardStyles.css">
<link rel="stylesheet" type="text/css" href="styles/toolbarStyles.css">
<link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="http://code.jquery.com/jquery-1.10.2.js"></script>
<script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script>
    var x = 0;
    var y = 0;
    var timer2 = "1:00";
    var interval;
    var auto_refresh1;

    $(document).ready(function() {
        startGame();
    });

    function startGame(){
        $.ajax({
            url: "getGameState.php", success: function (result) {
                if (parseInt(result) === -1) {
                    interval = setInterval(getGameState, 1000);
                }
                else{
                    play();
                }
            }
        });
    }

    function takeSquare(tdId, x, y) {
        $.ajax({
            url: "takeSquare.php?x=" + x + "&y=" + y,
            success: function (result) {
                var img = document.createElement("img");
                img.src = "imgs/x.png";

                src = document.getElementById(tdId);
                document.getElementById(tdId).innerHTML = "";
                src.appendChild(img);

                if (parseInt(result) === 1) {
                    $.ajax({
                        url: "checkWin.php?x=" + x + "&y=" + y,
                        success: function (result) {
                            switch (result) {
                                case "0":
                                    //continue game
                                    play();
                                    break;
                                case "1":
                                    setGameState(1);
                                    //player 1 won
                                    break;
                                case "2":
                                    setGameState(2);
                                    //player 2 won
                                    break;
                                case "3":
                                    setGameState(3);
                                    //draw
                                    break;
                                case "ERROR-RETRIEVE":
                                    window.alert("Issue collecting game details.");
                                    break;
                                case "ERROR-NOGAME":
                                    window.alert("No game can be found.");
                                    break;
                                case "ERROR-DB":
                                    window.alert("Error DB");
                                    break;
                            }
                        }
                    });
                }
            }
        });
    }

    function checkSquare(tdId, x, y) {
        $.ajax({
            url: "checkSquare.php?x=" + x + "&y=" + y, success: function (result) {
                if (parseInt(result) === 0) {
                    takeSquare(tdId, x, y);
                }
                else{
                    document.getElementById("turns").innerHTML = "This tile is taken. Try another."
                    $("#turns").css('color', 'red');
                }

            }
        });
    }

    function play(){
        $.ajax({
            url: "getGameState.php", success: function (result) {
                if (parseInt(result) === 0) {
                    $.ajax({
                        url: "checkTurn.php", success: function (result) {
                            if (parseInt(result) === 1 || parseInt(result) === 3) {
                                $("#board").css("pointer-events","auto");
                                document.getElementById("turns").innerHTML = "Click tile to take your turn.";
                                $("#turns").css('color', 'green');
                                $(document).on('click', '#grid td', function () {
                                    y = this.cellIndex;
                                    x = this.parentNode.rowIndex;
                                    var tdId = jQuery(this).attr("id");
                                    checkSquare(tdId,x,y);
                                });
                            }
                            else waitForTurn();
                        }
                    });
                }
            }
        });
    }


    function waitForTurn(){
        $("#board").css("pointer-events","none");
        auto_refresh1 = setInterval(
            function () {
                $.ajax({
                    url: 'checkTurn.php',
                    success: function (result) {
                        document.getElementById("turns").innerHTML = "Your opponent is taking their turn.";
                        $("#turns").css('color', 'blue');
                        $("#turns").fadeIn(1000).fadeOut(1000);
                        if (parseInt(result) !== 0) {
                            clearInterval(auto_refresh1);
                            play();
                        }
                    }
                })
            }, 50);
    }


    function getGameState() {
        $.ajax({
            url: 'getGameState.php', success: function (result) {
                document.getElementById("turns").innerHTML = "Waiting for opponent to join.";
                $("#turns").fadeIn(1000).fadeOut(1000);

                var timer = timer2.split(':');
                        var minutes = parseInt(timer[0], 10);
                        var seconds = parseInt(timer[1], 10);

                        --seconds;
                        minutes = (seconds < 0) ? --minutes : minutes;
                        seconds = (seconds < 0) ? 59 : seconds;
                        seconds = (seconds < 10) ? '0' + seconds : seconds;

                        $('#countdown').html(minutes + ':' + seconds);
                        if (minutes < 0) clearInterval(interval);

                        //check if both minutes and seconds are 0
                        if ((seconds <= 0) && (minutes <= 0)) {
                            clearInterval(interval);
                            $.ajax({
                                url: "deleteGame.php", success: function (result) {
                                    if (result === "1") {
                                        window.alert("No one has joined the game :(");
                                        window.location.href = "dashboard.php?id=<?php echo $_SESSION['id'];?>&uname=<?php echo $_SESSION['uname']?>";
                                    } else {
                                        window.alert("Error, cannot delete game.");
                                        window.location.href = "dashboard.php?id=<?php echo $_SESSION['id'];?>&uname=<?php echo $_SESSION['uname']?>";
                                    }
                                }
                            });
                        }
                        timer2 = '0' + minutes + ':' + seconds;

                        if (parseInt(result) === 0) {
                            document.getElementById('countdown').innerHTML = "";
                            document.getElementById('turns').innerHTML = "";
                            location.reload();
                        }
                    }
                });
    }

    /*
     * This function is used to set the game state.
     * @param is the current game state based on the last move taken.
     */
    function setGameState(i){
        $.ajax({
            url: "setGameState.php?state=" + i,
            success: function (result) {
            }
        });
    }

    /*
     * This function is used to constantly check if the game has finished.
     * The game result will be shown on the screen as an alert.
     * The user will be re-directed to the dashboard.
     */
    var auto_refresh2 = setInterval(
        function()
        {
            $.ajax({
                url: 'getGameState.php',
                success:
                    function (data) {
                        switch (parseInt(data)) {
                            case 1:
                                clearInterval(interval);clearInterval(auto_refresh1);clearInterval(auto_refresh2);
                                alert("Game over!! - Player 1 wins!!");
                                window.location.href = "dashboard.php?id=<?php echo $_SESSION['id'];?>&uname=<?php echo $_SESSION['uname']?>";
                                break;
                            case 2:
                                clearInterval(interval);clearInterval(auto_refresh1);clearInterval(auto_refresh2);
                                alert("Game over!! - Player 2 wins!!");
                                window.location.href = "dashboard.php?id=<?php echo $_SESSION['id'];?>&uname=<?php echo $_SESSION['uname']?>";
                                break;
                            case 3:
                                clearInterval(interval);clearInterval(auto_refresh1);clearInterval(auto_refresh2);
                                alert("Seriously?.. A draw?... Y'all are both smart");
                                window.location.href = "dashboard.php?id=<?php echo $_SESSION['id'];?>&uname=<?php echo $_SESSION['uname']?>";
                                break;
                        }
                }
            })
        },300);

    /*
     * This function is used to constantly refresh the game board.
     * It caches the data of the board and checks if any changes happen.
     * If a change takes place it then refreshes the board.
     */
    var cacheData;
    var data = $('#board').html();
    var auto_refresh = setInterval(
        function()
        {
            $.ajax({
                url: 'getBoard.php',
                type: 'POST',
                dataType: 'html',
                success:
                    function (data, status) {
                        if(data !== cacheData) {
                            cacheData = data;
                            data: data;
                            $('#board').html(data);
                        }}})
        },500);





</script>
<div id="result"></div>
</body>
</html>