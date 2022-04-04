<?php
include 'header.php';
$item_per_page = !empty($_GET['per_page'])?$_GET['per_page']:4;
$current_page = !empty($_GET['page'])?$_GET['page']:1; //Trang hiện tại
$offset = ($current_page - 1) * $item_per_page;
$use = mysqli_query($con, "USE `test`");
$products = mysqli_query($con, "SELECT * FROM `product` ORDER BY `id` ASC  LIMIT " . $item_per_page . " OFFSET " . $offset);
$totalRecords = mysqli_query($con, "SELECT * FROM `product`");
$totalRecords = $totalRecords->num_rows;
$totalPages = ceil($totalRecords / $item_per_page);
    ?>
<style type="text/css">
.admin-heading-panel {
    background: #f3f1f1;
    height: 60px;
    line-height: 50px;
    color: #fff;
}

.content-wrapper {
    background: #f3f1f1;
    padding: 10px 10px;
}

#content-wrapper .container {
    padding: 25px 10px;
    float: left;
}

.container {
    width: 200px;
    margin: 0 auto;
}

.main-content {
    width: 980px;
    margin-right: -1020px;
    float: right;
    padding-top: 0px;
    padding-left: 25px;
}
</style>
<div class="main-content">
    <h1>Danh sách sản phẩm</h1>
    <div class="product-items">
        <div class="buttons">
            <a href="./addProduct.php">Thêm sản phẩm</a>
        </div>
        <ul>
            <li class="product-item-heading">
                <div class="product-prop product-img">Ảnh</div>
                <div class="product-prop product-name">Tên sản phẩm</div>
                <div class="product-prop product-price">Giá</div>
                <div class="product-prop product-description">Thông tin sản phẩm</div>
                <div class="product-prop product-number">Số lượng</div>
                <div class="product-prop product-brand">Hãng</div>
                <div class="product-prop product-button">Xóa</div>
                <div class="clear-both"></div>
            </li>
            <?php 
            
                   while($row = mysqli_fetch_array($products)){
                ?>
            <li>
                <div class="product-prop product-img"><img src="../<?= $row['image'] ?>" alt="<?= $row['name'] ?>"
                        title="<?= $row['name'] ?>" /></div>
                <div class="product-prop product-name"><?= $row['name'] ?></div>
                <div class="product-prop product-price"><?= $row['price'] ?></div>
                <div class="product-prop product-description"><?= $row['description'] ?></div>
                <div class="product-prop product-number"><?= $row['number'] ?></div>
                <div class="product-prop product-brand"><?= $row['brand'] ?></div>
                <div class="product-prop product-button">
                    <a href="./delProduct.php?id=<?= $row['id'] ?>">Xóa</a>
                </div>
                <div class="clear-both"></div>
            </li>
            <?php } ?>
        </ul>
        <?php
            include './pagination.php';
            ?>
        <div class="clear-both"></div>
    </div>
</div>
</body>
</html>