<?php
	
$servername = "remotemysql.com";
$username = "GBtyfP4tfL";
require("mysql.password.php");
$dbname = "GBtyfP4tfL";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // sql to create table
    $sql = "CREATE TABLE MyGuests (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    firstname VARCHAR(30) NOT NULL,
    lastname VARCHAR(30) NOT NULL,
    email VARCHAR(50),
    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";
    // use exec() because no results are returned
    //$conn->exec($sql);
    //echo "Table MyGuests created successfully";
	
		$sql="CREATE TABLE IF NOT EXISTS fund (
	 cid INTEGER PRIMARY KEY,
	 name TEXT NOT NULL,
	 email TEXT NOT NULL,
	 KEY ix_length_email (email(255)),
	 amount INTEGER NOT NULL,
	 comment BLOB
	)ENGINE=InnoDB;";
	$conn->query($sql);
	
	
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

$conn = null;



?>