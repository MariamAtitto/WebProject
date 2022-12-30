<?php

include 'config.php';

if(isset($_POST['submit'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = mysqli_real_escape_string($conn, md5($_POST['password']));
   $cpass = mysqli_real_escape_string($conn, md5($_POST['cpassword']));
   $address = mysqli_real_escape_string($conn, $_POST['address']);
   $phone = mysqli_real_escape_string($conn, $_POST['phone']);
   $location = mysqli_real_escape_string($conn, $_POST['location']);
   $filename = $_FILES["profilePic"]["name"];
   $tempname = $_FILES["profilePic"]["tmp_name"];  
   $folder = "images/".$filename; 
   $user_type = $_POST['user_type'];

   $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email' AND password = '$pass'") or die('query failed');

   if(mysqli_num_rows($select_users) > 0){
      $message[] = 'user already exist!';
   }else{
      if($pass != $cpass){
         $message[] = 'confirm password not matched!';
      }else{
         $insert="INSERT INTO `users`(name, email, password, user_type , address ,phone ,location ,profilePic) VALUES('$name', '$email', '$cpass', '$user_type' ,'$address','$phone' ,'$location' , '$filename')";
         mysqli_query($conn, $insert) or die('query failed');
         $upload = mysqli_query($conn, $insert);
         if($upload){
            move_uploaded_file($tempname, $folder);
            $message[] = 'registered successfully!';
            header('location:login.php');
      }
      
   }
   }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>register</title>


    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/register.css">

</head>

<body>



    <?php
if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>

    <div class="form-container">


        <form action="" method="post" action="<?php $_SERVER['PHP_SELF'] ?>" method="post"
            enctype="multipart/form-data">

            <h3>Register</h3>
            <label>Name</label>
            <input type="text" name="name" placeholder="enter your name" required class="box">
            <label>Phone</label>
            <input type="text" name="phone" required placeholder="enter your phone number" class="box">
            <label>Email</label>
            <input type="email" name="email" placeholder="enter your email" required class="box">
            <label>Password</label>
            <input type="password" name="password" placeholder="enter your password" required class="password">
            <input type="password" name="cpassword" placeholder="confirm your password" required class="password">
            <label>User Type</label>
            <select name="user_type" class="box">
                <option value="user">user</option>
                <option value="admin">admin</option>
            </select>
            <label>Address</label>
            <input type="text" name="address" required placeholder="enter your Address" class="address">
            <label>Location</label>
            <input type="text" name="location" placeholder="enter your location" class="address">
            
            <label>Profile Picture</label>
            <input type="file" name="profilePic" accept="image/png, image/jpeg, image/jpg" required
                placeholder="Upload your Profile Picture" class="box">
            <button class="button" name="submit">Register </button>  
                        <p>already have an account? <a href="login.php">login now</a></p>
        </form>

    </div>

</body>

</html>