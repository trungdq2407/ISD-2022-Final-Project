<?php
include 'header.php';
{
?>
<style type="text/css">
.main-content {
    width: 900px;
    margin-right: -931px;
    float: right;
    padding-top: 0;
}

#content-box {
    border: 1px solid #ccc;
    padding: 10px;
}

#product-form label {
    width: 150px;
    display: block;
    float: left;
}

#product-form input {
    margin-bottom: 10px;
    line-height: 32px;
    float: right;
}

#product-form textarea {
    width: 500px;
    height: 200px;
}

#product-form input[type=submit] {
    float: right;
    background: url('../../images/save.png') center center no-repeat;
    background-size: 32px 32px;
    height: 32px;
    width: 32px;
    border: 0;
    cursor: pointer;
}

</style>
    <div class="main-content">
        <h1>Thêm sản phẩm</h1>
        <div id="content-box">
            <?php
            if (isset($_GET['action']) && $_GET['action'] == 'add') {
                if (isset($_POST['name']) && !empty($_POST['name']) && isset($_POST['price']) && !empty($_POST['price']) && isset($_POST['number']) && !empty($_POST['number']) && isset($_POST['brand']) && !empty($_POST['brand'])) {
                    $galleryImages = array();
                    if (empty($_POST['name'])) {
                        $error = "Bạn phải nhập tên sản phẩm";
                    } elseif (empty($_POST['price'])) {
                        $error= "Bạn phải nhập giá sản phẩm";
                    } elseif (!empty($_POST['price']) && is_numeric(str_replace('.', '', $_POST['price'])) == false) {
                        $error = "Giá nhập không hợp lệ";
                    } elseif (empty($_POST['description'])) {
                        $error = "Bạn phải nhập thông tin sản phẩm";
                    } elseif (!empty($_POST['number']) && is_numeric(str_replace('.', '', $_POST['number'])) == false) {
                        $error = "Số lượng không hợp lệ";
                    } elseif (empty($_POST['brand'])) {
                        $error = "Bạn phải thêm brand";
                    } 
                    if (isset($_FILES['image']) && !empty($_FILES['image']['name'][0])) {
                        $uploadedFiles = $_FILES['image'];
                        $result = uploadFiles($uploadedFiles);
                        if (!empty($result['errors'])) {
                            $error = $result['errors'];
                        } else {
                            $image = $result['path'];
                        }
                    }             
                    if (!isset($error)) {
                        $result = mysqli_query($con, "INSERT INTO product (id, name, image, price, description, number, brand) VALUES (NULL, '" . $_POST['name'] . "','" . $image . "', " . str_replace('.', '', $_POST['price']) . ", '" . $_POST['description'] . "', '" . $_POST['number'] . "', '" . $_POST['brand'] . "' );");
                        if (!$result) {
                            $error = "Có lỗi xảy ra trong quá trình thực hiện.";
                        }
                    }
                } else {
                    $error = "Bạn chưa nhập thông tin sản phẩm.";
                }
                ?>
                <div class = "container">
                    <div class = "error"><?= isset($error) ? $error : "Cập nhật thành công" ?></div>
                    <a href = "addProduct.php">Quay lại trang thêm sản phẩm</a>
                    <a href = "product_listing.php">Quay lại danh sách sản phẩm</a>
                </div>
            <?php } else { ?>
                <form id="product-form" method="POST" action="?action=add"  enctype="multipart/form-data">
                    <input type="submit" title="Lưu sản phẩm" value="" />
                    <div class="clear-both"></div>
                    <div class="wrap-field">
                        <label>Tên sản phẩm: </label>
                        <input type="varchar" name="name" value="" />
                        <div class="clear-both"></div>
                    </div>
                    <div class="wrap-field">
                        <label>Giá sản phẩm: </label>
                        <input type="float" name="price" value="" />
                        <div class="clear-both"></div>
                    </div>
                    <div class="wrap-field">
                        <label>Số lượng sản phẩm: </label>
                        <input type="int" name="number" value="" />
                        <div class="clear-both"></div>
                    </div>
                    <div class="wrap-field">
                        <label>Hãng: </label>
                        <input type="varchar" name="brand" value="" />
                        <div class="clear-both"></div>
                    </div>
                    <div class="wrap-field">
                        <label>Ảnh đại diện: </label>
                        <div class="right-wrap-field">
                            <input type="file" name="image" />
                        </div>
                        <div class="clear-both"></div>
                    </div>
                    <div class="wrap-field">
                        <label>Nội dung: </label>
                        <textarea name="description" id="product-content"></textarea>
                        <div class="clear-both"></div>
                    </div>
                </form>
                <div class="clear-both"></div>
            <?php } ?>
        </div>
    </div>
<?php } ?>

