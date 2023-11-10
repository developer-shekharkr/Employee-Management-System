<?php
$server="localhost";
$user="root";
$password="";
$database="employee";

$con=mysqli_connect($server,$user,$password,$database);
if(!$con){
    echo "connection faild";
echo "<br>".mysqli_connect_error();
}

?>