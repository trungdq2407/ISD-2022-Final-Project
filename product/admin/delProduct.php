<?php
include 'header.php';
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
.box-content{
    width: 938px;
    border: 1px solid #ccc;
    text-align: center;
    padding: 20px;
}
</style>
    <div class="main-content">
        <h1>Xóa sản phẩm</h1>
        <div id="content-box">
            <?php
            $error = false;
            if (isset($_GET['id']) && !empty($_GET['id'])) {
                include '../connect_db.php';
                $result = mysqli_query($con, "DELETE FROM  product WHERE `id`= " . $_GET['id']);
                if (!$result) {
                    $error = "Không thể xóa sản phẩm.";
                }
                mysqli_close($con);
                if ($error !== false) {
                    ?>
                    <div id="error-notify" class="box-content">
                        <h2>Thông báo</h2>
                        <h4><?= $error ?></h4>
                        <a href="./product_listing.php">Danh sách sản phẩm</a>
                    </div>
        <?php } else { ?>
                    <div id="success-notify" class="box-content">
                        <h2>Xóa sản phẩm thành công</h2>
                        <a href="./product_listing.php">Danh sách sản phẩm</a>
                    </div>
                <?php } ?>
    <?php } ?>
        </div>
    </div>
