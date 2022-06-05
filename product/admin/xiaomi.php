<!DOCTYPE html>
<html lang="sv">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link type="text/css" href="main.css" rel="stylesheet" />
    <link type="text/css" href="style.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"
        integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA=="
        crossorigin="anonymous" />
    <script src="JS/jquery-3.5.1.min.js"></script>
    <script src="JS/multislider.min.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <title>WEB ĐIỆN THOẠI</title>
</head>

<!--Navbar-->
<style>


.product-price {
    color: red;
    font-weight: bold;
}

.btn-small {
    border: none;
    font-size: 0.9rem;
    width: 50%;
    height
    padding: 15px;
    background-color: white;
    box-shadow: 2px 2px 2px #49989e;
    color: black;
    margin-bottom: 10px;
    cursor: pointer;
}

.btn-small:hover {
    background-color: #49989e;
    color: white;
}
</style>

<body>
    <!--Navbar-->
    <nav>
        <!--Navbar has two part the top one and the bottom one-->
        <!--Here is top one and in this part I put logo, my account part, and the shopping cart-->
        <div class="navbar-top">
            <div>
                <button id="menuButton"><i class="fas fa-bars"></i></button>
                <!--Logo-->

                <a href="../index.php" id="logo">
                    <img src="../Images/Other/apple.png" alt="">

                </a>


            </div>
            <div>
                <!--My account part-->
                <div class="account">
                    <a href="">
                        <!-- <button class="account-btn">
                            <i class="fas fa-user-alt"></i>
                        </button> -->

                        <li class="header__navbar-item header__navbar-user">

                            <span class="account-text">
                                <?php 
                                    include '../connect_db.php';
                                    // session_start();                                    
                                    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
                                        $user_id = $_SESSION['user_id'];
                                        $use = mysqli_query($con, "USE `manage_account`");
                                        $select = mysqli_query($con, "SELECT * FROM `user_information` WHERE id = '$user_id'") or die('query failed');
                                        if (mysqli_num_rows($select) > 0) {
                                            $fetch = mysqli_fetch_assoc($select);
                                        }
                                        echo "Hi, " .$fetch['name'];
                                    } else {
                                        echo "<a href='login.php' class='account-text-login' style=''>Đăng nhập</a>";
                                        echo " <style>
                                                .header__navbar-user:hover .header__navbar-user-menu {display: none; }
                                            </style>";                                                                                                       
                                    }
                                ?>
                            </span>
                            <ul class="header__navbar-user-menu">
                                <li class="header__navbar-user-item">
                                    <a href="update_profile.php" class="">Cập nhật thông tin</a>
                                </li>
                                <li class="header__navbar-user-item">
                                    <?php 
                                        include 'config.php';
                                        $user_id = $_SESSION['user_id'];
                                        
                                        if (isset($_GET['logout'])) {
                                            unset($user_id);
                                            session_destroy();
                                            header('location: login.php');
                                        }
                                    ?>
                                    <a href="index.php?logout=<?php echo $user_id; ?>" class="">Đăng xuất</a>

                                </li>
                            </ul>
                        </li>
                    </a>

                </div>
                <!--Shopping cart-->
                <div class="shopping-cart" id="cart">
                    <div class="sum-prices">
                        <!--Shopping cart logo-->
                        <i class="fas fa-shopping-cart shoppingCartButton" aria-hidden="true"></i>
                        <!-- <span>0</span> -->
                        <!--The total prices of products in the shopping cart -->
                    </div>
                </div>
            </div>
        </div>
        <!-- Navbar bottom part -->
        <!-- Here I put the links to the other pages or nav links -->
        <div class="navbar" id="navbar">
        <ul class="links">
                <li class="nav-links">
                    <a href="samsung.php" class="link"><strong>Samsung</strong></a>
                </li>
                <li class="nav-links">
                    <a href="xiaomi.php" class="link"><strong>Xiaomi</strong></a>
                </li>
                <li class="nav-links">
                    <a href="oppo.php" class="link"><strong>Oppo</strong></a>
                </li>
                <li class="nav-links">
                    <a href="nokia.php" class="link"><strong>Nokia</strong></a>
                </li>
                <li class="nav-links">
                    <a href="iphone.php" class="link"><strong>Iphone</strong></a>
                </li>
                <li class="nav-links">
                    <a href="vivo.php" class="link"><strong>Vivo</strong></a>
                </li>
                <li class="nav-links">
                    <a href="asus.php" class="link"><strong>ASUS</strong></a>
                </li>
                <li class="nav-links">
                    <a href="realme.php" class="link"><strong>Realme</strong></a>
                </li>
            </ul>


            <!-- The searchbar which will be in the right side of the links -->
            <div class="searchbar">
                <form action="#">
                    <input type="search" placeholder="Bạn muốn tìm kiếm sản phẩm nào" />
                    <i class="fa fa-search" id="search-icon"></i>
                </form>
            </div>
        </div>
        <!-- <div class="producstOnCart hide">
            <div class="overlay"></div>
            <div class="top">
                <button id="closeButton">
                    <i class="fas fa-times-circle"></i>
                </button>
                <h3>Giỏ hàng</h3>
            </div>
            <ul id="buyItems">
                <h4 class="empty">Giỏ hàng của bạn đang trống</h4>
            </ul>
            <button class="btn checkout hidden">Kiểm tra giỏ hàng ngay</button>
        </div> -->
    </nav>

    <?php
       include '../connect_db.php';  
       include '../function.php';      
       session_start();
       $use = mysqli_query($con, "USE `test`");
       $products = mysqli_query($con, "SELECT * FROM `product` WHERE brand = 'xiaomi' ORDER BY `price` ASC");
       $totalRecords = mysqli_query($con, "SELECT * FROM `product`");
  
    ?>
    <div class="mobile-phones">
        <ul class="phones">
            <li class="phone">
                <?php
                while ($row = mysqli_fetch_array($products)) {
                    ?>
                <div class="phone-under">
                    <div class="product-image">
                        <img src="../<?= $row['image'] ?>" alt="<?= $row['name'] ?>" title="<?= $row['name'] ?>" />
                        <div class="product-over">
                            <button class="btn btn-small addToCart">
                                <i class="fas fa-cart-plus"></i>Thêm vào giỏ hàng
                            </button>
                            <a href="detail_page.html" class="btn btn-small">Xem chi tiết</a>
                        </div>
                    </div>
                    <div class="product-summary">
                        <strong><?= $row['name'] ?></strong><br />
                        <span class="stars"></span>
                        <span class="product-price"><?= number_format($row['price'], 0, ",", ".") ?>
                            đ</span><br />
                    </div>
                </div>
                <?php } ?>
                <div class="clear-both"></div>
            </li>
        </ul>
    </div>
</body>

</html>