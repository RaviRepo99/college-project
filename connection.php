connection.php
<?php
$servername = "localhost";
$fullname = "root";
$password = "";
$dbname = "loginsystem";
$con = new mysqli($servername, $fullname, $password);
if (!$con) {
    die("Connection failed!!");
} else {
    // echo("Connection Done :)");
}
$sql = "CREATE DATABASE IF NOT EXISTS $dbname";
$query = mysqli_query($con, $sql);
if (!$query) {
    die("<br>Couldn't created DATABASE!!") . mysqli_connect_error();
} else {
    // echo("<br>DATABASE CREATED SUCCESSFULLY :)");
}
$con->select_db("$dbname");
$sql = "CREATE TABLE IF NOT EXISTS users (
    id int(30) PRIMARY KEY NOT NULL AUTO_INCREMENT,
    fullname VARCHAR(50) NOT NULL,
    email VARCHAR(50) NOT NULL,
    password VARCHAR(50) NOT NULL
)";
$query = mysqli_query($con, $sql);
if (!$query) {
    die("<br>TABLE COULDN'T CREATED!!") . mysqli_connect_error();
} else {
    // echo("<br>TABLE CREATED SUCCESSFULLY :)");
}
?>
