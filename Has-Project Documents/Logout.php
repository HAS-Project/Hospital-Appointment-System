<?php
   session_start();
   unset($_SESSION["username"]);
   unset($_SESSION["password"]);
   session_destroy();
   echo 'You have cleaned session';
   header('Refresh: 1; URL = index.php');
?>