<?php
    session_start();
    include_once "config.php";
    $fname = mysqli_real_escape_string($conn, $_POST['fname']);
    $lname = mysqli_real_escape_string($conn, $_POST['lname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    if (!empty($fname) && !empty($lname) && !empty($email) && !empty($password)) {
        // validation
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            // check existing email
            $sql = mysqli_query($conn, "SELECT email FROM users WHERE email = '{$email}'");
            if (mysqli_num_rows($sql) > 0) {
                echo "Emaill is existing!!!";
            } else {
                // check user upload file or not
                if(isset($_FILES['image'])) {
                    // file is uploaded
                    $img_name = $_FILES['image']['name']; //getting user uploaded image name
                    $img_type = $_FILES['image']['type']; //getting user uploaded image type
                    $tmp_name = $_FILES['image']['tmp_name']; //this temporary name is used to save/move file in our folder

                    // explode image and get the last extension like jpg png
                    $img_explode = explode('.', $img_name);
                    $img_ext = end($img_explode); //here we get the extension of an user uploaded img file
                    $extensions = ['png', 'jpeg', 'jpg'];
                    if(in_array($img_ext, $extensions) === true) {
                        // check img extension
                        $time = time();
                        $new_img_name = $time.$img_name;
                        $status = "Active now"; //once user signed up then his status will be active now
                        $random_id = rand(time(), 10000000); //creating random id for user
                        
                        $sql2 = mysqli_query($conn, "INSERT INTO users (unique_id, fname, lname, email, password, img, status)    
                                                VALUES ({$random_id}, '{$fname}', '{$lname}', '{$email}', '{$password}', '{$new_img_name}', '{$status}')");
                        if($sql2) {
                            move_uploaded_file($tmp_name, "images/".$new_img_name);
                            // if these data inserted
                            $sql3 = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$email}'");
                            if (mysqli_num_rows($sql3) > 0) {
                                $row = mysqli_fetch_assoc($sql3);
                                $_SESSION[ 'unique_id'] = $row['unique_id']; // using this session we used user unique_id in other php file
                                echo "success";
                            }
                        } else {
                            echo "$random_id-$fname-$lname-$email-$password-$new_img_name-$status";
                            // printf($sql2->error);
                            // echo "Something went wrong!";
                        }
                    } else {
                        echo "you can upload only jpg, png, jpeg";
                    }

                } else {
                    echo "please select an image file";
                }
            }
        } else {
            echo "Invalid email!";
        }
    } else {
        echo "All fields are required!";
    }
?>