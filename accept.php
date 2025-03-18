<?
 require './auth.php';
 
 $email = $_SESSION['email'];
 $check = mysqli_query($conn, "SELECT * FROM user WHERE email = '$email'");
 if(mysqli_num_rows($check) > 0) {
    $query = mysqli_query($conn, "UPDATE user SET 
        status   = 1 ,
        WHERE email = '$email'");
}
else{
    echo " Failed  ";
}

?>