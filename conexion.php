<?php
function conectar(){
    $user="root";
    $pass="";
    $server="localhost";
    $db="barberia";
    $mysqli = new mysqli($server,$user,$pass,$db);

    // Check connection
    if ($mysqli -> connect_errno) {
      echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
      exit();
    }
    return $mysqli;
}
?>