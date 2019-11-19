<?php
session_start();
include_once 'WebServiceClient.php';

if (!empty($_POST["gameid"]) && !isset($_SESSION['gameid'])) {
    $gameid = (int)$_POST["gameid"];
    $_SESSION['gameid'] = $gameid;
    $result = $client->joinGame(array("uid" => $_SESSION['id'], "gid" => $gameid));
    switch ($result->return) {
        case "ERROR-DB":
            echo "There has been an error: ERROR-DB";
            break;
        case "1":
            echo "Joined. gameid from joinGame: ". $gameid;
            break;
        default:
            echo "Unable to join";
    }
} else if(!(isset($_SESSION['gameid']))) {
    $result = $client->newGame(array("uid" => $_SESSION['id']));
    $gameid = $result->return;
    switch ($gameid) {
        case "ERROR-NOTFOUND":
            echo "There has been an error: ERROR-NOTFOUND";
            break;
        case "ERROR-RETRIEVE":
            echo "There has been an error: ERROR-RETRIEVE";
            break;
        case "ERROR-INSERT":
            echo "There has been an error: ERROR-INSERT";
            break;
        case "ERROR-DB":
            echo "There has been an error: ERROR-DB";
            break;
        default:
            echo "<div class='alert alert-info'>";
            echo 'Successfully created game';

            echo "<br> gameid from newGame is: $gameid";
            echo "</div>";
            $_SESSION['gameid'] = $gameid;
    }
}
echo "<br>";
if(isset($_SESSION['gameid']))
    echo "gameid(sesh): " . $_SESSION['gameid'];
else
    echo "gameid(reg): " . $gameid;
?>
<!DOCTYPE html>
<html>
<head>
    <title>board</title>
    <link rel="stylesheet" type="text/css" href="styles/boardStyles.css">
</head>
<body>
<div align="center" id="dynamic_grid">

</div>

<link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="http://code.jquery.com/jquery-1.10.2.js"></script>
<script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script>


    var cacheData;
    var liveData = $('#dynamic_grid').html();
    var auto_refresh = setInterval(
        function()
        {
            $.ajax({
                url: 'boardUpdates.php',
                type: 'POST',
                dataType: 'html',
                success: function(liveData){
                    if(liveData !== cacheData) {
                        cacheData = liveData;
                        liveData: liveData;
                        $('#dynamic_grid').html(liveData);
                    }}})
        },250);

    var num = 0;
    var x = 0;
    var y = 0;
    var gid = <?php echo $gameid?>;
    var uid = <?php echo $_SESSION['id']?>;


    //This function checks if one of the grid squares was clicked and sets the X and Y co-ordinates
    $('#grid td').click(function() {
        y = this.cellIndex;
        x = this.parentNode.rowIndex;
        var flag = false;

        /* This function checks if it is the first turn or if it is the logged in users go.
         * Flag is set to true if it is your turn. */
        $.ajax({url: "getBoard.php?gid=" + gid, success: function(result) {
            if(result==="ERROR-NOMOVES")flag = true;
            else if (result==="ERROR-DB")flag = false;
            else{
                var array1 = result.split("\n");
                var last_element = array1[array1.length - 1];
                last_element = last_element(",");
                flag = !(uid === parseInt(last_element[0]));
            }

            //This function checks if the square clicked is available and if it is it takes that square.
            if(flag) {
            $.ajax({url: "checkSquare.php?gid=" + gid + "&x=" + x + "&y=" + y, success: function (result) {
                if (parseInt(result) === 0) {
                    $.ajax({
                        url: "takeSquare.php?pid=" + uid + "&gid=" + gid + "&x=" + x + "&y=" + y,
                        success: function (result) {
                            if (parseInt(result) === 1) {
                               // var img = document.createElement("img");
                                //img.src = "imgs/x.png";
                                //var src = document.getElementById("" + x + "-" + y);
                                //src.appendChild(img);
                                }
                            else if (parseInt(result) === 0) window.alert("Error");
                            else window.alert(result);
                        }
                    });
                }
                else if (parseInt(result) === 1) window.alert("This square is already taken. Please pick another.");
                else window.alert(result);
            }});
            }
        }});
    });
</script>
</body>
</html>