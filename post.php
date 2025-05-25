<?php
    require './auth.php';
    
    $email = $_SESSION['email'];

    $res1 = mysqli_query($conn," SELECT * FROM application WHERE a_email = '$email' ");
    while($row1 = mysqli_fetch_array($res1)){
        $profile = $row1['a_profile'];
        $resume = $row1['a_resume'];
        $about = $row1['a_about'];
        $post = $row1['a_post'];
    }

    $res2 = mysqli_query($conn," SELECT * FROM user WHERE email = '$email' ");
    while($row2 = mysqli_fetch_array($res2)){
        $name = $row2['name'];
    }

    $check = mysqli_query($conn, "SELECT * FROM post WHERE p_email = '$email'");

    if(mysqli_num_rows($check) > 0) {
        // Email exists, update the record
        $query = mysqli_query($conn, "UPDATE post SET 
            p_name = '$name',
            p_profile= '$profile',
            p_resume = '$resume',
            p_about = '$about',
            p_post = '$post',
            p_date = current_timestamp()
            WHERE p_email = '$email'");
        header("Location: index.php?posted=1");
        exit;
    } else {
        // Email does not exist, insert new record
        $query = mysqli_query($conn, "INSERT INTO post (p_email, p_name, p_profile, p_resume, p_about, p_post, p_date) 
        VALUES ('$email', '$name', '$profile', '$resume', '$about','$post',current_timestamp())");
        header("Location: index.php?posted=1");
        exit;
    }   


?>