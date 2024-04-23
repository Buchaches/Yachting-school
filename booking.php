<?php 
    include "path.php"; 
    include "./app/database/db.php"; 
?>
<?php 
    if(isset($_SESSION['email'])){
        if($_SESSION["email"] == ""){
            header('location:' . BASE_URL. 'login.php');
        }
    }else{
        header('location:' . BASE_URL . 'login.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>YarYachts - Бронирование</title> 

    <!-- -------------   CSS   ------------- -->
    <link rel="stylesheet" href="../assets/css/booking.css">
    <link rel="stylesheet" href="../assets/css/media.css">
    <!-- -----------   END CSS   ----------- -->
    
    <!-- -------------   Favicon   ------------- -->
    <link rel="apple-touch-icon" sizes="180x180" href="../assets/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../assets/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/favicons/favicon-16x16.png">
    <link rel="manifest" href="../assets/favicons/site.webmanifest">
    <link rel="mask-icon" href="../assets/favicons/safari-pinned-tab.svg" color="#3a3a3a">
    <meta name="msapplication-TileColor" content="#3a3a3a">
    <meta name="theme-color" content="#3a3a3a">
    <!-- -----------   END Favicon   ----------- -->
    
</head>
<body>
    <div class="booking">
        <div class="header">
            <a href="<?php echo BASE_URL ?>" class="logo"><strong>Yar</strong>Yachts</a>
            <div class="header__account">
                <lord-icon id="menuButton" onclick="toggleMenu()" src="https://cdn.lordicon.com/kthelypq.json" trigger="click" colors="primary:#fff" style="width:32px;height:32px"></lord-icon>
                <ul class="header__account__menu" id="dropdownMenu">
                    <?php if ($_SESSION['role_id'] === '3'): ?>
                        <li class="header__account__menu-items">
                            <a class="header__account__menu-item" href="<?php echo BASE_URL . 'client/client.php'?>" class="">Личный кабинет</a>
                        </li>
                    <?php elseif ($_SESSION['role_id'] === '2'): ?>
                        <li class="__account__menu-items">
                            <a class="header__account__menu-item" href="<?php echo BASE_URL . 'instructor/instructor.php'?>" class="">Инструкторская</a>
                        </li>
                    <?php elseif ($_SESSION['role_id'] === '1'): ?>
                        <li class="__account__menu-items">
                            <a class="header__account__menu-item" href="<?php echo BASE_URL . 'admin/index.php'?>" class="">Админ панель</a>
                        </li>
                    <?php endif; ?>
                    <li class="header__account__menu-items">
                        <a class="header__account__menu-item" href="<?php echo BASE_URL . 'logout.php'?>" class="">Выйти</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="form">
            
        </div>
    </div>

<!-- -------------   JS   ------------- -->
<script src="./assets/js/lordicon.js"></script>
<script src="./assets/js/booking/booking.js"></script>
<!-- -----------   END JS   ----------- -->

</body>
</html>