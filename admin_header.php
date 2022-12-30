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

<header class="header">

    <div class="flex">

        <a href="admin_page.php" class="logo" style="color:#e84393;">Market<span></span></a>

        <nav class="navbar">
            <a href="admin_page.php">home</a>
            <a href="admin_products.php">products</a>
            <a href="admin_orders.php">orders</a>
            <a href="admin_users.php">users</a>
            <a href="admin_contacts.php">messages</a>
        </nav>

        <div class="icons">
            <div id="menu-btn" class="fas fa-bars"></div>
            <div id="user-btn" class="fas fa-user"></div>
        </div>

        <div class="account-box">
            <img src="images/<?php echo $_SESSION['admin_profilePic']; ?>" alt="" width=100px height=100px
                style="border-radius:50%;">
            <p>username : <span><?php echo $_SESSION['admin_name']; ?></span></p>
            <p>email : <span><?php echo $_SESSION['admin_email']; ?></span></p>
            <p>address : <span><?php echo $_SESSION['admin_address']; ?></span></p>
            <p>phone : <span><?php echo $_SESSION['admin_phone']; ?></span></p>

            <a href="edit_admin.php" class="delete-btn" style="background-color:#e84393;">Update Profile</a>
            <a href="logout.php" class="delete-btn">logout</a>

            <div>new <a href="login.php" style="color:#e84393;">login</a> | <a href="register.php"
                    style="color:#e84393;">register</a> </div>

        </div>

</header>