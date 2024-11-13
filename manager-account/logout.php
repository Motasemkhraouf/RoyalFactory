<?php

ob_start();
session_start();
session_unset();
ob_end_flush();
echo"<meta http-equiv='Refresh' content='1;url=../home/login.php'/>";
exit;


?>
