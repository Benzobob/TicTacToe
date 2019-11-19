<?php
session_start();
include_once 'WebServiceClient.php';
$pid = $_SESSION['id'];
$gid = $_SESSION['gameid'];
$result = $client->getBoard(array("gid" => $gid));
$results = explode("\n", $result->return);

foreach ($results as $value) {
    $array2 = explode("," , $value);
    if($pid===(int)$array2[0]){
        $x = $array2[1];
        $y = $array2[2];
        echo "<script> document.getElementById" . "(" .$x . "-" . $y . ") = 'hi';</script>";
        //Print an x at these co-ordinates
    }
    else{
        echo "nope";
    }
}
//Echo table headers
echo <<<'EOD'
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
EOD;


?>