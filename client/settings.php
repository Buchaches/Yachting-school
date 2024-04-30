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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
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
                    <div class="settings__items">
                        <a href="?action=edit&id=<?=$_SESSION['client_id']?>&error=0" class="settings__link element-animation">
                            <div class="settings__img">
                                <svg xmlns="http://www.w3.org/2000/svg" height="30px" viewBox="0 0 24 24" width="30px" fill="#1b62b3"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M14.06 9.02l.92.92L5.92 19H5v-.92l9.06-9.06M17.66 3c-.25 0-.51.1-.7.29l-1.83 1.83 3.75 3.75 1.83-1.83c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.2-.2-.45-.29-.71-.29zm-3.6 3.19L3 17.25V21h3.75L17.81 9.94l-3.75-3.75z"/></svg>
                            </div>
                            <div class="settings__text">
                                <div class="settings__title">Настроить профиль</div>
                                <div class="settings__desc">Отредактировать данные профиля и изменить пароль</div>
                            </div>
                        </a>
                        <a href="?action=drop&id=<?=$_SESSION['client_id']?>" class="settings__link delete element-animation">
                            <div class="settings__img">
                                <svg xmlns="http://www.w3.org/2000/svg" height="30px" viewBox="0 0 24 24" width="30px" fill="#E32636"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M16 9v10H8V9h8m-1.5-6h-5l-1 1H5v2h14V4h-3.5l-1-1zM18 7H6v12c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7z"/></svg>
                            </div>
                            <div class="settings__text">
                                <div class="settings__title">Удалить аккаунт</div>
                                <div class="settings__desc">Все данные будут удалены навсегда без возможности восстановления</div>
                            </div>
                        </a>
                    </div>
                    <?php
                        if($_GET){
                            $id=$_GET["id"];
                            $action=$_GET["action"];

                            if($action == 'edit'){
                                $errorGet=$_GET["error"];
                                $errorlist= array(
                                    '1'=>'Не все поля заполнены!',
                                    '2'=>'Введите номер телефона полностью!',
                                    '3'=>'Такого пароля не существует',
                                    '4'=>'Пользователь с такой почтой уже уже существует!',
                                    '5'=>'',
                                    '0'=>'',
                                );
                                $client = selectOne('clients',['client_id'=>$id]);
                                $surname = $client['client_surname'];
                                $name = $client['client_name'];
                                $phone = $client['client_phone'];
                                $user_id =$client['user_id'];
                                $users = selectOne('users',['user_id'=> $user_id]);
                                $oldemail = $users['email'];
                                $oldpass = $users['password'];
                                if($errorGet!= '5'){
                                    echo '
                                    <div id="popup" class="overlay">
                                        <div class="popup">
                                            <a class="close" href="settings.php">&times;</a>
    
                                            <form class="add__form row" method="post" action="'. BASE_URL .'app/controllers/client/settings.php">
                                                <h2 class="form__title">Редактирование профиля</h2>
                                                <input name="client_id" value="'.$id.'" type="hidden">
                                                <input name="user_id" value="'.$user_id.'" type="hidden">
                                                <input name="oldemail" value="'.$oldemail.'" type="hidden">
                                                <input name="oldpass" value="'.$oldpass.'" type="hidden">
                                                <div class="mb-3">
                                                    <div class="row">
                                                        <div class="col">
                                                            <label for="exampleInputName" class="form-label">Имя</label>
                                                            <input name="name" value="'.$name.'" type="text" class="form-control" id="exampleInputName" required>
                                                        </div>
                                                        <div class="col">
                                                            <label for="exampleInputSurname" class="form-label">Фамилия</label>
                                                            <input name="surname" value="'.$surname.'" type="text" class="form-control" id="exampleInputSurname" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="exampleInputEmail" class="form-label">Email</label>
                                                    <input name="email" value="'.$oldemail.'" type="email" class="form-control" id="exampleInputEmail" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="exampleInputTel" class="form-label">Номер телефона</label>
                                                    <input name="phone" value="'.$phone.'" type="tel" class="form-control" id="exampleInputTel" placeholder="+7(___)___-__-__" required>
                                                </div>
                                                <div class="mb-3 password">
                                                    <label for="exampleInputPassword" class="form-label">Старый пароль</label>
                                                    <input name="pass" type="password" class="password form-control" id="exampleInputPassword" placeholder="Введите старый пароль" required>
                                                    <i class="bi bi-eye-slash" id="togglePassword"></i>
                                                </div>
                                                <div class="mb-3 password">
                                                    <label for="exampleInputPasswordNew" class="form-label">Новый пароль</label>
                                                    <input name="passNew" type="password" class="password form-control" id="exampleInputPasswordNew" placeholder="Введите новый пароль" required>
                                                    <i class="bi bi-eye-slash" id="togglePasswordNew"></i>
                                                </div>
                                                <div class="mb-3">
                                                    <p class="form__err">'.$errorlist[$errorGet].'</p>
                                                </div>
                                                <div class="mb-3">
                                                    <button type="submit" class="submit__btn primary__btn" name="edit__btn">Изменить</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>';
                                }else{
                                    echo '
                                    <div id="popup" class="overlay">
                                        <div class="popup">
                                            <a class="close" href="settings.php">&times;</a>
                                            <div class="content">
                                                <h2 class="popup__title">Запись успешно изменена!</h2>
                                                <a href="settings.php" class="primary__btn added__btn">OK</a>
                                            </div>
                                        </div>
                                    </div>';
                                }
                            }else if($action == 'drop'){
                                $email = $_SESSION['email'];
                                echo '
                                <div id="popup" class="overlay">
                                    <div class="popup">
                                        <a class="close" href="settings.php">&times;</a>
                                        <div class="content">
                                            <div>
                                                <h2 class="popup__title">Вы точно хотите удалить свой профиль?</h2>
                                                <h3 class ="popup__subtitle">'.$email.'</h3>
                                            </div>
                                            <div class="popup__buttons">
                                                <a href="'.BASE_URL.'app/controllers/client/settings.php?action=drop&id='.$id.'" class="primary__btn delete__btn">Да</a>
                                                <a href="settings.php" class="primary__btn delete__btn">Нет</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>';
                            }
                        }
                    ?>
                </div>
            </main>
        </div>
    </div>
<!-- ---------------   JS   --------------- -->
<script src="../assets/js/animation.js"></script>
<script src="../assets/js/libraries/imask.js"></script>
<script src="../assets/js/libraries/lordicon.js"></script>
<script src="../assets/js/sidebar.js"></script>
<script src="../assets/js/client/settings.js"></script>
<!-- -------------   END js   ------------- -->

</body>
</html>