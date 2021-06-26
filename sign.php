<?php
session_start();
include('admin2/security.php');

if(isset($_POST['regi']))
{
    $fullnames = $_POST['fullnames'];
    $sdate = $_POST['sdate'];
    $cdate = $_POST['cdate'];
    $email = $_POST['email'];
    $choice = $_POST['choice'];
    $pwd = $_POST['pwd'];
    $cpwd = $_POST['cpwd'];

    $email_query = "SELECT * FROM signlogin WHERE email='$email' ";
    $email_query_run = mysqli_query($connection, $email_query);
    if(mysqli_num_rows($email_query_run) > 0)
    {
        $_SESSION['status'] = "Email Already Taken. Please Try Another one.";
        $_SESSION['status_code'] = "error";
        header('Location: signlogin.php');  
    }
    else
    {
        if($password === $cpassword)
        {
            $query = "INSERT INTO signlogin (fullnames,sdate,cdate,email,choice,pwd,cpwd) 
            VALUES ('$fullnames','$sdate','$cdate','$email', '$choice', '$pwd', '$cpwd')";
            $query_run = mysqli_query($connection, $query);
            
            if($query_run)
            {
                // echo "Saved";
                $_SESSION['success'] = "new member added";
                header('Location: signlogin.php');
            }
            else 
            {
                $_SESSION['status'] = "Failed to register";
                header('Location: signlogin.php');  
            }
        }
        else 
        {
            $_SESSION['status'] = "Password and Confirm Password Does Not Match";
            header('Location: register.php');  
        }
    }

}

