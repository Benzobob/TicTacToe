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
            echo "Joined";
            break;
        default:
            echo "Unable to join";
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
    <table id="results">
        <tr>
            <td id="2-0"></td>
            <td id="2-1" class="v"></td>
            <td id="2-2"></td>
        </tr>
        <tr>
            <td id="1-0" class="h"></td>
            <td id="1-1" class="h v"></td>
            <td id="1-2" class="h"></td>
        </tr>
        <tr>
            <td id="0-0"></td>
            <td id="0-1" class="v"></td>
            <td id="0-2"></td>
        </tr>
    </table>
</div>

<?php
$result = $client->getBoard(array("uid" => $_SESSION['id']));
?>

<script>
    document.getElementById("0-0").onclick = function() {myFunction("0-0")};
    document.getElementById("0-1").onclick = function() {myFunction("0-1")};
    document.getElementById("0-2").onclick = function() {myFunction("0-2")};
    document.getElementById("1-0").onclick = function() {myFunction("1-0")};
    document.getElementById("1-1").onclick = function() {myFunction("1-1")};
    document.getElementById("1-2").onclick = function() {myFunction("1-2")};
    document.getElementById("2-0").onclick = function() {myFunction("2-0")};
    document.getElementById("2-1").onclick = function() {myFunction("2-1")};
    document.getElementById("2-2").onclick = function() {myFunction("2-2")};

    function myFunction(pos) {
        document.getElementById(pos).innerHTML = pos;
    }
</script>

</body>
</html>