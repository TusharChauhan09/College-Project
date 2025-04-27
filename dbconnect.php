<?php

$server = 'localhost';
$usernamedb = 'root';
$passworddb = '';
$database = 'college-project';

$conn = mysqli_connect($server,$usernamedb , $passworddb , $database);

if(!$conn){
    die('Failed to connect to the DB'. mysqli_connect_error());
}
// else{
//     echo 'Successfuly connected to the DB';
// }

 
?>