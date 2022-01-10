<?php

ob_start();
session_start();

function db_connect()
{
    $host = "localhost";
    $dbUser = "root";
    $dbPass = "";
    $dbName = "bidding_db";
    $conn = mysqli_connect($host, $dbUser, $dbPass, $dbName) or die("DB Connection Error :" . mysqli_connect_error());

    echo "<script> console.log('Connection Success'); </script>";
    return $conn;
}

function db_close($conn)
{
    mysqli_close($conn);
}
?>