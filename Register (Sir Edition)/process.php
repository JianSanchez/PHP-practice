<?php
session_start();    
include("config.php");

// if(isset($_POST["loginButton"])){

//     $email = $_POST['email'];
//     $password = $_POST['password'];

//     $login_query = "SELECT `id`, `email`, `password`, `fname`, `mname`, `lname` FROM `users` WHERE `email` = '$email' AND `password` = '$password' LIMIT 1 ";
//     $login_result = mysqli_query($con, $login_query);

//     if(mysqli_num_rows($login_result) == 1){
//         $_SESSION['status'] = "Welcome!";
//         $_SESSION['status_code'] = "success";
//         header("Location: index.php");
//         exit();
//     }else{
//         $_SESSION['status'] = "Invalid Username/Password";
//         $_SESSION['status_code'] = "error";
//         header("Location: login.php");
//         exit();
//     }
// }





if(isset($_POST["registerButton"])){

    $email = $_POST['email'];
    $password = $_POST['password'];
    $repassword = $_POST['repassword'];
    $fname = $_POST['fname'];
    $mname = isset($_POST['mname']) ? $_POST['mname'] : '' ;
    $lname = $_POST['lname'];

    $check_email_query = "SELECT * FROM `users` WHERE `email` = '$email'";
    $email_result = mysqli_query($con,$check_email_query);
    $email_count = mysqli_fetch_array($email_result)[0];

    if($email_count > 0){
        $_SESSION['status'] = "Email address already taken";
        $_SESSION['status_code'] = "error";
        header("Location: register.php");
        exit();
    }

    if ($password !== $repassword){
        $_SESSION['status'] = "Password does not match";
        $_SESSION['status_code'] = "error";
        header("Location: register.php");
        exit();
    }


    $query = "INSERT INTO `users`(`email`, `password`, `fname`, `mname`, `lname`) VALUES ('$email','$password','$fname','$mname','$lname')";
    $query_result = mysqli_query( $con, $query );

    if($query_result){
        $_SESSION['status'] = "Registration Sucess!";
        $_SESSION['status_code'] = "success";
        header("Location: login.php");
        exit();
    }
}


if(isset($_POST["loginButton"])){

    $email = $_POST['email'];
    $password = $_POST['password'];

    $login_query = "SELECT `id`, `email`, `password`, `fname`, `mname`, `lname` FROM `users` WHERE `email` = '$email' AND `password` = '$password' LIMIT 1 ";
    $login_result = mysqli_query($con, $login_query);

    if($login_result){
        if (mysqli_num_rows($login_result) > 0){    
            $data = mysqli_fetch_assoc($login_result);

            $user_id = $data['id'];
            $full_name = $data['fname'] . '' . $data['mname'] . '' . $data['lname'];
            $user_mail = $data['email'];

            $_SESSION['auth'] = true;
            $_SESSION['auth_user'] = [
                'user_id' => $user_id,
                'user_name' => $full_name,
                'user_email' => $user_email,
            ];

            $_SESSION['status'] = "Welcome $full_name!";
            $_SESSION['status_code'] = "success";
            header("Location: index.php");
            exit();
    }else{
        $_SESSION['status'] = "Invalid Username/Password";
        $_SESSION['status_code'] = "error";
        header("Location: login.php");
        exit();
    }
}else{
             $_SESSION['status'] = "Error executing the login query" . mysqli_error( $con );
            $_SESSION['status_code'] = "success";
            header("Location: login.php");
            exit();
}
}

if(isset($_POST["insertButton"])){

    $student_id = $_POST['email'];
    $Fname = $_POST['password'];
    $Mname = $_POST['email'];
    $Lname = $_POST['email'];
    $year = $_POST['email'];
    $section = $_POST['email'];

    $login_query = "SELECT `id`, `email`, `password`, `fname`, `mname`, `lname` FROM `users` WHERE `email` = '$email' AND `password` = '$password' LIMIT 1 ";
    $login_result = mysqli_query($con, $login_query);

    if($login_result){
        if (mysqli_num_rows($login_result) > 0){    
            $data = mysqli_fetch_assoc($login_result);

            $user_id = $data['id'];
            $full_name = $data['fname'] . '' . $data['mname'] . '' . $data['lname'];
            $user_mail = $data['email'];

            $_SESSION['auth'] = true;
            $_SESSION['auth_user'] = [
                'user_id' => $user_id,
                'user_name' => $full_name,
                'user_email' => $user_email,
            ];

            $_SESSION['status'] = "Welcome $full_name!";
            $_SESSION['status_code'] = "success";
            header("Location: index.php");
            exit();
    }else{
        $_SESSION['status'] = "Invalid Username/Password";
        $_SESSION['status_code'] = "error";
        header("Location: login.php");
        exit();
    }
}else{
             $_SESSION['status'] = "Error executing the login query" . mysqli_error( $con );
            $_SESSION['status_code'] = "success";
            header("Location: login.php");
            exit();
}
}

?>