<?php session_start();

////needed to populate table of open games. Will likely need to be moved into thread.
//include_once 'WebServiceClient.php';
//$result = $client->showOpenGames();
//$results = explode("\n", $result->return);
////
?>
<!DOCTYPE html>
<html>
<head>
    <title>Gameboard</title>
    <link rel="stylesheet" type="text/css" href="tableStyle.css">
</head>
<body>
<?php
echo $_POST["gameid"];
?>

</body>
</html>
