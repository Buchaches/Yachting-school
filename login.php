<?php 
    include "path.php"; 
    include "./app/controllers/users.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Авторизация</title>

    <!-- -------------   CSS   ------------- -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="./assets/css/main.css">
    <link rel="stylesheet" href="./assets/css/media.css">
    <link rel="stylesheet" href="./assets/css/users.css">
    <!-- -----------   END CSS   ----------- -->

    <!-- -------------   Favicon   ------------- -->
    <link rel="apple-touch-icon" sizes="180x180" href="./assets/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="./assets/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="./assets/favicons/favicon-16x16.png">
    <link rel="manifest" href="./assets/favicons/site.webmanifest">
    <link rel="mask-icon" href="./assets/favicons/safari-pinned-tab.svg" color="#3a3a3a">
    <meta name="msapplication-TileColor" content="#3a3a3a">
    <meta name="theme-color" content="#3a3a3a">
    <!-- -----------   END Favicon   ----------- -->
    
</head>

<body>
    <?php include("./app/include/header.php"); ?>
    
    <div class="register container">
        <form class="register__form row" method="post" accesskey="login.php">
            <h2 class="register__title">Авторизация</h2>
            <div class="mb-3">
                <label for="exampleInputEmail" class="form-label">Email</label>
                <input name="email" value="<?=$email?>" type="email" class="form-control" id="exampleInputEmail" required>
            </div>
            <div class="mb-3 password">
                <label for="exampleInputPassword" class="form-label">Пароль</label>
                <input name="pass" type="password" class="password form-control" id="exampleInputPassword" required>
                <i class="bi bi-eye-slash" id="togglePassword"></i>
            </div>
            <div class="mb-3">
                <p class="form__err"><?=$errMsg?></p>
            </div>
            <div class="mb-3">
                <button type="submit" class="submit__btn" name="login__btn">Войти</button>
            </div>
            <div class="link">
                <div class="link__text">Нет учетной записи?</div>
                <a href="<?php echo BASE_URL ?>signup.php">Создать</a>
            </div>
        </form>
    </div>    

    <?php include("app/include/footer.php"); ?>

<!-- -------------   JS   ------------- -->
<script src="./assets/js/header.js"></script>
<script src="../assets/js/libraries/lordicon.js"></script>
<script src="./assets/js/login/login.js"></script>
<!-- -----------   END JS   ----------- -->

</body>
</html>