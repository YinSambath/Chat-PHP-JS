<?php
    session_start();
    include_once "config.php";
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    
    if (!empty($email) && !empty($password)) {
        // check users entered correct email & password matched or not 
        $sql = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$email}'");
        if(mysqli_num_rows($sql) > 0 ) {
            $row = mysqli_fetch_assoc($sql);
            if (password_verify($password, $row['password'])) {
                $status = "Active now";
                $sql2 = mysqli_query($conn, "UPDATE users SET status = '{$status}' WHERE unique_id = {$row['unique_id']}");
                if($sql2) {
                    $_SESSION['unique_id'] = $row['unique_id']; // using this session we used user unique_id in other php file
                    echo "success";
                }
            } else {
                echo "Password is not correct";
                echo $row['password'];
                echo "-----";
                echo "$hash_password";
            }
        } else {
            echo "Email is not correct";
        }
    } else {
        echo "All inputs are required";
    }
?>