<?php

include 'connect_db.php';

if(isset($_GET['delete'])){

   $delete_id = $_GET['delete'];
   $delete_product_image = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
   $delete_product_image->execute([$delete_id]);
   $fetch_delete_image = $delete_product_image->fetch(PDO::FETCH_ASSOC);
   unlink('./uploaded_img/'.$fetch_delete_image['image_01']);
   unlink('./uploaded_img/'.$fetch_delete_image['image_02']);
   unlink('./uploaded_img/'.$fetch_delete_image['image_03']);
   $delete_product = $conn->prepare("DELETE FROM `products` WHERE id = ?");
   $delete_product->execute([$delete_id]);
   $delete_cart = $conn->prepare("DELETE FROM `cart` WHERE pid = ?");
   $delete_cart->execute([$delete_id]);
   header('location:products.php');
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>products</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <link rel="stylesheet" href="../css/admin_style.css">

</head>

<body>

    <?php include '../components/admin_header.php'; ?>

    <section class="show-products">

        <h1 class="heading">Products added</h1>

        <div class="box-container">

            <?php
      $select_products = $conn->prepare("SELECT * FROM `products`");
      $select_products->execute();
      if($select_products->rowCount() > 0){
         while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){ 
   ?>
            <div class="box">
                <img src="../uploaded_img/<?= $fetch_products['image_01']; ?>" alt="">
                <div class="name"><?= $fetch_products['name']; ?></div>
                <div class="price"><span><?= $fetch_products['price']; ?></span>VND</div>
                <div class="details"><span><?= $fetch_products['details']; ?></span></div>
                <div class="brand"><?= $fetch_products['brand']; ?></div>
                <div class="quantity"><?= $fetch_products['quantity']; ?></div>
                <div class="flex-btn">
                    <a href="update_product.php?update=<?= $fetch_products['id']; ?>" class="option-btn">update</a>
                    <a href="products.php?delete=<?= $fetch_products['id']; ?>" class="delete-btn"
                        onclick="return confirm('delete this product?');">delete</a>
                </div>
            </div>
            <?php
         }
      }else{
         echo '<p class="empty">no products added yet!</p>';
      }
   ?>

        </div>

    </section>


    <script src="../js/admin_script.js"></script>

</body>

</html>