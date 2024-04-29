<?php 
    include "./../path.php";
    include "./../app/database/db.php"; 
?>
<?php 
    if(isset($_SESSION['email'])){
        if($_SESSION["email"] == "" or $_SESSION['role_id']!='3'){
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
    <title>Личный кабинет - Настройки</title>
    
    <!-- -------------   CSS   ------------- -->
    <link rel="stylesheet" href="../assets/css/dashboard.css">
    <link rel="stylesheet" href="../assets/css/dashmedia.css">
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
    <div class="dashboard">
        <?php include("../app/include/client_sidebar.php"); ?>
        <div class="body">
            <header class="header">
                <button id="sidebar-btn" class="sidebar-btn">
                    <img id="sidebar-btn-img" src="./../assets/img/icon/sidebar_menu/sidebar-open.svg" alt="Nav button">
                </button>   
                <h1 class="header__title">Настройки</h1>
                <div class="header__calendar">
                    <div class="calendar__text">
                        <p class="calendar__title">Today's Date</p>
                        <p class="calendar__date">
                            <?php
                                date_default_timezone_set('Europe/Moscow');
                                $date = date('Y-m-d');
                                $time = date("H:i:s");
                                echo $date;
                            ?>
                        </p>
                    </div>
                    <div class="calendar__img">
                        <lord-icon src="https://cdn.lordicon.com/abfverha.json" trigger="hover" colors="primary:#1a1a1a" style="width:40px;height:40px"></lord-icon>
                    </div>
                </div>
            </header>
            <main class="main">
                <div class="main__container">
                    
                </div>
            </main>
        </div>
    </div>
<!-- ---------------   JS   --------------- -->
<script src="../assets/js/animation.js"></script>
<script src="../assets/js/libraries/lordicon.js"></script>
<script src="../assets/js/sidebar.js"></script>
<!-- -------------   END js   ------------- -->

</body>
</html>