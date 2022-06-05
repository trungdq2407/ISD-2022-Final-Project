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

   <section class="flex">
   <a class="logo">Admin<span>Panel</span></a>

      <nav class="navbar">
         <a href="../admin/products.php">Products</a>
         <a href="../admin/add_products.php">Add Product</a>
         <a href="../admin/placed_orders.php">Orders</a>
      </nav>

      <div class="icons">
         <div id="menu-btn" class="fas fa-bars"></div>
         <div id="user-btn" class="fas fa-user"></div>
      </div>

      <div class="profile">
         
         <p><?= $fetch_profile['name']; ?></p>
         <div class="flex-btn">
            <a href="../admin/admin_login.php" class="option-btn">login</a>
         </div>
         <a href="admin_logout.php" class="delete-btn" onclick="return confirm('logout from the website?');">logout</a> 
      </div>

   </section>

</header>