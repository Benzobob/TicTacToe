<?php
session_start();
include_once 'WebServiceClient.php';

if (!empty($_POST["gameid"])) {
    $gameid = (int)$_POST["gameid"];
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
} else {
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
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>board</title>
    <link rel="stylesheet" type="text/css" href="styles/boardStyles.css">
</head>
<body>
<div align="center">
    <table id="grid">
        <tr>
            <td id="0-0"></td>
            <td id="0-1" class="v"></td>
            <td id="0-2"></td>
        </tr>
        <tr>
            <td id="1-0" class="h"></td>
            <td id="1-1" class="h v"></td>
            <td id="1-2" class="h"></td>
        </tr>
        <tr>
            <td id="2-0"></td>
            <td id="2-1" class="v"></td>
            <td id="2-2"></td>
        </tr>
    </table>
</div>

<?php
$result = $client->getBoard(array("gid" => $gameid));
print_r($result->return);

?>

<link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="http://code.jquery.com/jquery-1.10.2.js"></script>
<script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script>
    var num = 0;
    var x = 0;
    var y = 0;
    var gid = <?php echo $gameid?>;



    $('#grid td').click(function() {
        y = this.cellIndex;
        x = this.parentNode.rowIndex;
        //if(y == 0) y = y + 2;
        //if(y == 2)  y = y - 2;
        $.ajax({url: "checkSquare.php?gid=" + gid + "&x=" + x + "&y=" + y, success: function(result) {
                var word = result;
                document.getElementById("" + x + "-" + y).innerHTML = word;
            }});
    });
</script>

</body>
</html>
<?php
function checkSqr($x, $y) {
echo "Hello world!";
}
?>