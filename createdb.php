<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "exist";
$name_table = "exist";

// this code connects to the server to create a database and a table with the informations specified at the bottom inside the conditon

try {
    $conn = new PDO("mysql:host=$servername", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "CREATE DATABASE IF NOT EXISTS $database CHARACTER SET utf8 COLLATE utf8_general_ci";
    // use exec() because no results are returned
    $conn->exec($sql);
    if ($conn->exec($sql)) {
        $conn = null;
        try {
            $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "CREATE TABLE IF NOT EXISTS $name_table (
            id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            email VARCHAR(30) NOT NULL,
            lpassword VARCHAR(30) NOT NULL
            
            -- reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
            )";

            // use exec() because no results are returned
            $conn->exec($sql);
            echo "Table MyGuests created successfully";
        } catch (PDOException $e) {
            echo $sql . "<br>" . $e->getMessage();
        }

    }
    echo "Database created successfully<br>";
} catch (PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
}

$conn = null;
