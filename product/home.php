<?php
include 'config.php';
session_start();
$user_id = $_SESSION['user_id'];
if (!isset($user_id)) {
    header('location: login.php');
};

if (isset($_GET['logout'])) {
    unset($user_id);
    session_destroy();
    header('location: login.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="profile">
            <?php
                $use = mysqli_query($con, "USE `test`");
                $select = mysqli_query($con, "SELECT * FROM `user_information` WHERE id = '$user_id'") or die('query failed');
                if (mysqli_num_rows($select) > 0) {
                    $fetch = mysqli_fetch_assoc($select);
                }
                
            ?>
            <h1>
                <?php 
                    echo $fetch['name'];
                ?>
            </h1>
            <a href="update_profile.php" class="">Cập nhật thông tin cá nhân</a>
            <a href="home.php?logout=<?php echo $user_id; ?>" class="btn-delete">Đăng xuất</a>
        </div>
    </div>
</body>
</html>