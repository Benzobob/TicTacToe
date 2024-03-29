<?php session_start();
include_once 'WebServiceClient.php';
$result = $client->leagueTable();

$win = 0;
$lose = 0;
$draw = 0;
$username = "";
$userArray = array();
$array1 = explode("\n", $result->return);

if($array1[0] != "ERROR-NOGAMES") {
    foreach ($array1 as $value) {
        $array2 = explode(",", $value);
        array_push($userArray, $array2[1], $array2[2]); //Put every username into the array
        $userArray = array_unique($userArray);                  //Remove any duplicates
    }


    if (count($userArray) > 0) {

//Create a multidimensional array to hold each username and their corresponding win, draw and lose count.
        $users = array();
        foreach ($userArray as $name) {
            array_push($users, array($name, 0, 0, 0));
        }

        if (count($users) != 0) {
//Users now holds each unique username and the relative statistics for that user.
            foreach ($array1 as $value) {
                $array2 = explode(",", $value);


                //Deal with games that had a draw.
                if ((int)$array2[3] === 3) {
                    //find both array2[1] and array2[2] in $users and add 1 to draw for both
                    //for loop to go through $users
                    for ($row = 0; $row < count($users); $row++) {
                        if ($array2[1] === $users[$row][0]) {
                            $users[$row][3]++;  //Add 1 to draw for $array2[1]
                        }

                        if ($array2[2] === $users[$row][0]) {
                            $users[$row][3]++;  //Add 1 to draw for $array2[2]
                        }
                    }
                }

                //Deal with games where p2 won
                if ((int)$array2[3] === 2) {
                    //find both array2[1] and array2[2] in $user
                    //Add 1 to Lose for array2[1] (p1)
                    //Add 1 to Win for array2[2]  (p2)

                    //for loop to go through $users
                    for ($row = 0; $row < count($users); $row++) {
                        if ($array2[1] === $users[$row][0]) {
                            $users[$row][2]++;  //Add 1 to lose for $array2[1]
                        }


                        if ($array2[2] === $users[$row][0]) {
                            $users[$row][1]++;  //Add 1 to win for $array2[2]
                        }
                    }
                }

                //Deal with games where p1 won
                if ((int)$array2[3] === 1) {
                    //find both array2[1] and array2[2] in $user
                    //Add 1 to Win for array2[1] (p1)
                    //Add 1 to Lose for array2[2]  (p2)

                    //for loop to go through $users
                    for ($row = 0; $row < count($users); $row++) {
                        if ($array2[1] === $users[$row][0]) {
                            $users[$row][1]++;  //Add 1 to win for $array2[1]
                        }

                        if ($array2[2] === $users[$row][0]) {
                            $users[$row][2]++;  //Add 1 to lose for $array2[2]
                        }
                    }
                }
            }

            echo <<<'EOD'
<table style="width:50%; border: solid 4px darkcyan; background-color: white">
        <tr style="border: solid 4px darkcyan;">
            <th>Username</th>
            <th>Win</th>
            <th>Lose</th>
            <th>Draw</th>
        </tr>
EOD;

            for ($row = 0; $row < sizeof($users); $row++) {
                echo "<tr style=\"border: solid 2px darkcyan;\">";
                for ($col = 0; $col < 4; $col++) {
                    echo "<td>" . $users[$row][$col] . "</td>";
                }
                echo "</tr>";
            }
            echo("</table>");
        }
    }
}
else{
    echo "<h2> No games have been played yet. </h2>";
}


?>