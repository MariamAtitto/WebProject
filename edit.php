<?php

include 'config.php';
session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
};


if(isset($_POST['update'])){
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

    $_SESSION['user_name'] = $name;
    $_SESSION['user_email'] = $email;
    $_SESSION['user_password'] = $pass;
    $_SESSION['user_address'] = $address;
    $_SESSION['user_phone'] = $phone;
    $_SESSION['user_location'] = $location;
    $_SESSION['user_profilePic'] = $filename;

    if($pass != $cpass){
        $message[] = 'confirm password not matched!';
     }
       else{
           $update="UPDATE `users` SET name='$name', email='$email', password='$cpass', address='$address', phone='$phone', location='$location' WHERE id='$user_id'";
           mysqli_query($conn, $update) or die('query failed');
           $upload = mysqli_query($conn, $update);
           if($upload){
              mysqli_query($conn, "UPDATE `users` SET profilePic='$filename' WHERE id = '$user_id'") or die('query failed');
               move_uploaded_file($tempname, $folder);
               $message[] = 'updated successfully!';

       }
       header('location:home.php');
  }

   $message[] = 'product updated successfully!';

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit</title>


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

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

            <h3>Update Profile</h3>
            <label>Name</label>
            <input type="text" name="name" value=<?php echo $_SESSION['user_name']?> placeholder="enter your new name"
                required class="box">
            <label>Phone</label>
            <input type="text" name="phone" value=<?php echo $_SESSION['user_phone']?> required
                placeholder="enter your new phone number" class="box">
            <label>Email</label>
            <input type="email" name="email" value=<?php echo $_SESSION['user_email']?>
                placeholder="enter your new email" required class="box">
            <label>Password</label>
            <input type="password" name="password" placeholder="enter your new password" required class="password">
            <input type="password" name="cpassword" placeholder="confirm your new password" required class="password">
            <label>Address</label>
            <input type="text" name="address" value=<?php echo $_SESSION['user_address']?> required
                placeholder="enter your new Address" class="address">
            <label>Location</label>
            <input type="text" name="location" value=<?php echo $_SESSION['user_location']?>
                placeholder="enter your new location" class="address">

            <label>Profile Picture</label>
            <input type="file" name="profilePic" accept="image/png, image/jpeg, image/jpg" required
                placeholder="Upload your new Profile Picture" class="box">
            <button class="button" name="update">Update</button>
            <p>back to home? <a href="home.php">home</a></p>
        </form>

    </div>

</body>

</html>