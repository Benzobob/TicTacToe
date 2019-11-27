<?php
session_start();
session_unset();
session_destroy();
echo "<div class='alert alert-info'>";
echo 'Successfully logged out. <meta http-equiv="refresh" content="1; url=login.php">';
echo "</div>";
?>