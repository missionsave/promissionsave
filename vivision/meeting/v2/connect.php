<?php

// $servername = "remotemysql.com";
// $username = "GBtyfP4tfL";
// require("mysql.password.php");
// $dbname = "GBtyfP4tfL";
$servername = "sql108.epizy.com";
$username = "epiz_29317381";
$password = "sHmRRhzFyc";
$dbname = "epiz_29317381_a";
try {
    $db = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 	
    }
catch(PDOException $e)
    {
    echo "<br>PDO error: " . $e->getMessage();
    }

?>