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

</div>

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
    var turn;




    $(document).ready(function () {
        //This first ajax function checks who's turn it is.
        $.ajax({
            url: "getGameState.php", success: function (result) {
                if (parseInt(result) === 0) {
                $.ajax({
                    url: "checkTurn.php", success: function (result) {
                        if (parseInt(result) === 1 || parseInt(result) === 3) {
                            document.getElementById("turns").innerHTML = "Click tile to take your turn.";
                            $(document).on('click', '#grid td', function () {
                                y = this.cellIndex;
                                x = this.parentNode.rowIndex;
                                var tdId = jQuery(this).attr("id");

                                $.ajax({
                                    url: "checkSquare.php?x=" + x + "&y=" + y, success: function (result) {

                                        if (parseInt(result) === 0) {
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
                                                                        //continue check turn
                                                                        location.reload();
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
                                                    } else if (parseInt(result) === 0) window.alert("Error");
                                                    else window.alert(result);
                                                }
                                            });
                                        } else if (parseInt(result) === 1) window.alert("This square is already taken. Please pick another.");
                                        else window.alert(result);
                                    }
                                });
                            });
                        } else {
                            var auto_refresh = setInterval(
                                function () {
                                    $.ajax({
                                        url: 'checkTurn.php',
                                        success: function (result) {
                                            document.getElementById("turns").innerHTML = "Your opponent is taking their turn.";
                                            $("#turns").fadeIn(1000).fadeOut(1000);
                                            if (parseInt(result) !== 0) {
                                                location.reload();
                                            }
                                        }
                                    })
                                }, 250);
                        }

                    }
                });
            }
                else{
                    var auto_refresh = setInterval(
                        function () {
                            $.ajax({
                                url: 'getGameState.php',
                                success: function (result) {
                                    document.getElementById("turns").innerHTML = "Waiting for opponent to join.";
                                    $("#turns").fadeIn(1000).fadeOut(1000);
                                    if (parseInt(result) === 0) {
                                        window.alert("Opponent has joined.");
                                        location.reload();
                                    }
                                }
                            })
                        }, 250);
                }
            }

        });
    });


    function setGameState(i){
        $.ajax({
            url: "setGameState.php?state=" + i,
            success: function (result) {
                //
            }
        });
    }


    var auto_refresh1 = setInterval(
        function()
        {
            $.ajax({
                url: 'getGameState.php',
                success:
                    function (data) {
                        switch (parseInt(data)) {
                            case 1:
                                clearInterval(auto_refresh);
                                clearInterval(auto_refresh1);
                                alert("Game over!! - Player 1 wins!!");
                                window.location.href = "dashboard.php?id=<?php echo $_SESSION['id'];?>&uname=<?php echo $_SESSION['uname']?>";
                                break;
                            case 2:
                                clearInterval(auto_refresh);
                                clearInterval(auto_refresh1);
                                alert("Game over!! - Player 2 wins!!");
                                window.location.href = "dashboard.php?id=<?php echo $_SESSION['id'];?>&uname=<?php echo $_SESSION['uname']?>";
                                break;
                            case 3:
                                clearInterval(auto_refresh);
                                clearInterval(auto_refresh1);
                                alert("Seriously?.. A draw?... Y'all are both smart");
                                window.location.href = "dashboard.php?id=<?php echo $_SESSION['id'];?>&uname=<?php echo $_SESSION['uname']?>";
                                break;
                        }

                        }})
        },100);

    //Method to constantly update the board
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
        },250);


</script>
</body>
</html>