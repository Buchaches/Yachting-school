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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
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
            <a href="<?php echo BASE_URL ?>" class="logo no-select">
                <strong>Yar</strong>Yachts
                <img src="./assets/img/icon/yachts.svg" alt="logo">
            </a>

            <div class="header__account">
                <lord-icon id="menuButton" onclick="toggleMenu()" src="https://cdn.lordicon.com/kthelypq.json" trigger="click" colors="primary:#fff" style="width:36px;height:36px;cursor:pointer"></lord-icon>
                <ul class="header__account__menu" id="dropdownMenu">
                    <?php if ($_SESSION['role_id'] == '3'): ?>
                        <li class="header__account__menu-items">
                            <a class="header__account__menu-item" href="<?php echo BASE_URL . 'client/index.php'?>" class="">Личный кабинет</a>
                        </li>
                    <?php elseif ($_SESSION['role_id'] == '2'): ?>
                        <li class="__account__menu-items">
                            <a class="header__account__menu-item" href="<?php echo BASE_URL . 'instructor/index.php'?>" class="">Инструкторская</a>
                        </li>
                    <?php elseif ($_SESSION['role_id'] == '1'): ?>
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
        <?php
            $user_id = $_SESSION['user_id'];
            $role_id = $_SESSION['role_id'];
            if($role_id == '3'){
                $client = selectOne('clients',['user_id' => $user_id]);
                $client_id = $client['client_id'];
            }else{
                $client_id = 0;
            }
        ?>
        <div class="form">
            <div class="form__title no-select">Бронирование</div>
            <div class="capacity">
                <div class="number-input" min="1" max="24" step="1" value="1">
                    <lord-icon
                        class="number__btn"
                        id="decreaseButton"
                        onclick="decrease();"
                        src="https://cdn.lordicon.com/dykoqszm.json"
                        stroke="bold"
                        colors="primary:#2a2a2a,secondary:#2a2a2a"
                        style="width:50px;height:50px;cursor:pointer;opacity:0.2;">
                    </lord-icon>
                    <div class="value no-select">
                        <span id="number" class="number">1</span>
                        <span class="text">человек</span>
                    </div>
                    <lord-icon
                        class="number__btn"
                        id="increaseButton"
                        onclick="increase()"
                        src="https://cdn.lordicon.com/zrkkrrpl.json"
                        stroke="bold"
                        colors="primary:#2a2a2a,secondary:#2a2a2a"
                        style="width:50px;height:50px;cursor:pointer">
                    </lord-icon>
                </div>
            </div>
            <form action="<?php echo BASE_URL . '/app/controllers/bookings.php'?>" method="post">
                <input name="client" value="<?=$client_id?>" type="hidden">
                <input name="capacity" id="capacity" value="" type="hidden">
                <div class="mb-4">
                    <label for="exampleSelectDate" class="form-label no-select">Выберите дату</label>
                    <select name="sdate" id="exampleSelectDate" class="form-select" data-placeholder="Выберите дату">
                        <!-- Ajax запрос -->
                    </select>
                </div>
                <div class="mb-4" id="time" style="display:none;">
                    <label for="exampleSelectTime" class="form-label no-select">Выберите время</label>
                    <select name="slot" id="exampleSelectTime" class="form-select" data-placeholder="Выберите время">
                        <!-- Ajax запрос -->
                    </select>
                </div>
                <div class="mb-4" id="instructor" style="display:none;">
                    <label for="exampleSelectInstructor" class="form-label no-select">Выберите инструктора</label>
                    <select name="instructor" id="exampleSelectInstructor" class="form-select" data-placeholder="Выберите инструктора">
                        <!-- Ajax запрос -->
                    </select>
                    <div class="mt-2 mb-2">Мы стараемся учитывать ваши пожелания, но не всегда можем гарантировать присутствие конкретного инструктора.</div>
                </div>
                <div class="pt-2 mb-4 submit">
                    <div id="totalPrice" style="display:none;">
                        <div class="price-label">ЦЕНА</div>
                        <div class="price" id="price"></div>
                    </div>
                    <button type="submit" class="booking__btn" name="booking__btn" id="bookingBtn" disabled>Забронировать</button>
                </div>
            </form>
        </div>
    </div>

<!-- -------------   JS   ------------- -->
<script src="./assets/js/libraries/jquery.min.js"></script>
<script src="./assets/js/libraries/select2.min.js"></script>
<script src="./assets/js/libraries/lordicon.js"></script>
<script src="./assets/js/booking/booking.js"></script>
<!-- -----------   END JS   ----------- -->

</body>
</html>