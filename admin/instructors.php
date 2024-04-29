<?php 
    include "./../path.php";
    include "./../app/database/db.php";
?>
<?php 
    if(isset($_SESSION['email'])){
        if($_SESSION["email"] == "" or $_SESSION['role_id']!='1'){
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
    <title>Админ панель - Инструкторы</title>
    
    <!-- -------------   CSS   ------------- -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
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
        <?php include("../app/include/admin_sidebar.php"); ?>
        <div class="body">
            <header class="header">
                <button id="sidebar-btn" class="sidebar-btn">
                    <img id="sidebar-btn-img" src="./../assets/img/icon/sidebar_menu/sidebar-open.svg" alt="Nav button">
                </button>   
                <h1 class="header__title">Инструкторы</h1>               
                <form action="" method="post" class="header__search">
                    <input type="search" id="search" name="search" class="header__searchbar" placeholder="Введите имя или email инструктора">
                    <?php
                        echo '<datalist id="people">';
                        $instructors = selectAll("instructors");
                        $users = selectAll("users", ["role_id" => '2']);
                        foreach ($instructors as $instructor) {
                            $surname = $instructor["instructor_surname"];
                            $name = $instructor["instructor_name"];
                            $fullName = $surname . ' ' . $name;
                            echo "<option value='$fullName'>";  
                         }
                        foreach ($users as $user) {
                            $email = $user["email"];
                            echo "<option value='$email'><br/>";
                        }
                        echo ' </datalist>';                       
                    ?>
                    <button type="Submit" name="search__btn" value="Search" class="primary__btn search__btn">Поиск</button>
                </form>
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
                    <div class="add__new">
                        <div class="add__text">Добавить инструктора</div>
                        <a href="?action=add&id=none&error=0" class="primary__btn add__btn"><div><svg xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 0 24 24" width="20px" fill="#FFFFFF"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"/></svg>Add New</div></a>
                    </div>
                    <div class="row__counter">Всего инструкторов&nbsp;(<?=$totalClients = countRows("instructors")?>)</div>
                    <div class="table__container element-animation">
                        <table class="main__table">
                            <thead>
                                <tr>
                                    <th>Фамилия</th>
                                    <th>Имя</th>
                                    <th>Номер телефона</th>
                                    <th>Email</th>
                                    <th>Статус</th>
                                    <th>Аттестация</th>
                                    <th>Управление</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['search__btn'])){
                                        $keyword=trim($_POST["search"]);
                                        $sql = "SELECT instructors.instructor_id, instructors.instructor_surname, instructors.instructor_name, instructors.instructor_phone,instructors.status,instructors.certification, users.email
                                        FROM instructors
                                        INNER JOIN users ON instructors.user_id = users.user_id 
                                        WHERE users.email = '$keyword' OR users.email LIKE '$keyword%' OR users.email LIKE '%$keyword' OR users.email LIKE '%$keyword%'
                                        OR instructors.instructor_surname = '$keyword' OR instructors.instructor_surname LIKE '$keyword%' OR instructors.instructor_surname LIKE '%$keyword' OR instructors.instructor_surname LIKE '%$keyword%'
                                        OR instructors.instructor_name = '$keyword' OR instructors.instructor_name LIKE '$keyword%' OR instructors.instructor_name LIKE '%$keyword' OR instructors.instructor_name LIKE '%$keyword%'
                                        OR CONCAT(instructors.instructor_surname, ' ', instructors.instructor_name) = '$keyword' OR CONCAT(instructors.instructor_name, ' ', instructors.instructor_surname) = '$keyword'";
                                    }else{
                                        $sql = "SELECT instructors.instructor_id, instructors.instructor_surname, instructors.instructor_name, instructors.instructor_phone,instructors.status,instructors.certification, users.email
                                        FROM instructors
                                        INNER JOIN users ON instructors.user_id = users.user_id";                            
                                    }
                                    $query = $pdo->prepare($sql);
                                    $query->execute();
                                    dbCheckError($query);
                                    $rowCount = $query->rowCount();
                                    if($rowCount > 0){
                                        while ($row = $query->fetch()) {
                                            echo "<tr>" .
                                            "<td>" . $row['instructor_surname'] . "</td>" .
                                            "<td>" . $row['instructor_name'] . "</td>" .
                                            "<td style = 'white-space: nowrap'>" . $row['instructor_phone'] . "</td>" .
                                            "<td>" . $row['email'] . "</td>" .
                                            "<td class = 'colors' style = 'font-weight: 600'>" . $row['status'] . "</td>" .
                                            "<td class = 'colors' style = 'font-weight: 600'>" . $row['certification'] . "</td>" .
                                            "<td>
                                            <div class='controls__wrapper'>
                                            <a href='?action=edit&id=".$row['instructor_id']."&error=0' class='control__btn'>
                                            <div><svg class='control__icon' xmlns='http://www.w3.org/2000/svg' height='24px' viewBox='0 0 24 24' width='24px'><path d='M0 0h24v24H0V0z' fill='none'/><path d='M14.06 9.02l.92.92L5.92 19H5v-.92l9.06-9.06M17.66 3c-.25 0-.51.1-.7.29l-1.83 1.83 3.75 3.75 1.83-1.83c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.2-.2-.45-.29-.71-.29zm-3.6 3.19L3 17.25V21h3.75L17.81 9.94l-3.75-3.75z'/></svg>Edit</div></a>
                                            <a href='?action=drop&id=".$row['instructor_id']."&email=".$row['email']."' class='control__btn'>
                                            <div><svg class='control__icon' xmlns='http://www.w3.org/2000/svg' height='24px' viewBox='0 0 24 24' width='24px'><path d='M0 0h24v24H0V0z' fill='none'/><path d='M16 9v10H8V9h8m-1.5-6h-5l-1 1H5v2h14V4h-3.5l-1-1zM18 7H6v12c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7z'/></svg>Delete</div></a>
                                            </div>
                                            </td>" .
                                            "</tr>";
                                        }                                     
                                    } else { 
                                        echo '<tr>
                                        <td colspan="7">
                                        <img src="../assets/img/icon/not_found.svg" width="360px">
                                        <p>К сожалению, по вашему запросу ничего не найдено</p>
                                        <br><br>
                                        </td>
                                        </tr>'; 
                                    }
                                ?>           
                            </tbody>
                        </table>
                    </div>

                    <?php if($_GET){
                        $id=$_GET["id"];
                        $action=$_GET["action"];
                        if($action=='add'){
                            $errorGet=$_GET["error"];
                            $errorlist= array(
                                '1'=>'Не все поля заполнены!',
                                '2'=>'Введите номер телефона полностью!',
                                '3'=>'Пользователь с такой почтой уже уже существует!',
                                '4'=>'',
                                '0'=>'',
                            );
                            if($errorGet!= '4'){
                                echo '
                                <div id="popup" class="overlay">
                                    <div class="popup">
                                        <a class="close" href="instructors.php">&times;</a>

                                        <form class="add__form row" method="post" action="'. BASE_URL .'app/controllers/admin/instructor.php">
                                            <h2 class="form__title">Добавление инструктора</h2>
                                            <div class="mb-3">
                                                <div class="row">
                                                    <div class="col">
                                                        <label for="exampleInputName" class="form-label">Имя</label>
                                                        <input name="name" type="text" class="form-control" id="exampleInputName" required>
                                                    </div>
                                                    <div class="col">
                                                        <label for="exampleInputSurname" class="form-label">Фамилия</label>
                                                        <input name="surname" type="text" class="form-control" id="exampleInputSurname" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="exampleInputEmail" class="form-label">Email</label>
                                                <input name="email" type="email" class="form-control" id="exampleInputEmail" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="exampleInputTel" class="form-label">Номер телефона</label>
                                                <input name="phone" type="tel" class="form-control" id="exampleInputTel" placeholder="+7(___)___-__-__" required>
                                            </div>
                                            <div class="mb-3">
                                                <div class="row">
                                                    <div class="col">
                                                        <label for="single-select-status" class="form-label">Статус</label>
                                                        <select name="status" class="form-select" id="single-select-status" data-placeholder="" required>
                                                            <option></option>
                                                            <option>Основной состав</option>
                                                            <option>Запасной состав</option>
                                                            <option>Стажировка</option>
                                                            <option>Старший инструктор</option>
                                                        </select>
                                                    </div>
                                                    <div class="col">
                                                        <label for="single-select-certification" class="form-label">Аттестация</label>
                                                        <select name="certification" class="form-select" id="single-select-certification" data-placeholder="" required>
                                                            <option></option>
                                                            <option>Пройдена</option>
                                                            <option>Не пройдена</option>
                                                            <option>Пройдена частично</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-3 password">
                                                <label for="exampleInputPassword" class="form-label">Пароль</label>
                                                <input name="pass" type="password" class="password form-control" id="exampleInputPassword" required>
                                                <i class="bi bi-eye-slash" id="togglePassword"></i>
                                            </div>
                                            <div class="mb-3">
                                                <p class="form__err">'.$errorlist[$errorGet].'</p>
                                            </div>
                                            <div class="mb-3">
                                                <button type="submit" class="submit__btn primary__btn" name="add__btn">Добавить</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>';
                            }else{
                                echo '
                                <div id="popup" class="overlay">
                                    <div class="popup">
                                        <a class="close" href="instructors.php">&times;</a>
                                        <div class="content">
                                            <h2 class="popup__title">Новая запись успешно добавлена!</h2>
                                            <a href="instructors.php" class="primary__btn added__btn">OK</a>
                                        </div>
                                    </div>
                                </div>';
                            }
                        }else if($action== 'edit'){
                            $errorGet=$_GET["error"];
                            $errorlist= array(
                                '1'=>'Не все поля заполнены!',
                                '2'=>'Введите номер телефона полностью!',
                                '3'=>'Пользователь с такой почтой уже уже существует!',
                                '4'=>'',
                                '0'=>'',
                            );
                            $instructors= selectOne('instructors',['instructor_id' => $id]);
                            $name = $instructors['instructor_name'];
                            $surname = $instructors['instructor_surname'];
                            $phone = $instructors['instructor_phone'];
                            $user_id = $instructors['user_id'];
                            $users = selectOne('users',['user_id'=> $user_id]);
                            $email = $users['email'];
                            if($errorGet!= '4'){
                                echo '
                                <div id="popup" class="overlay">
                                    <div class="popup">
                                        <a class="close" href="instructors.php">&times;</a>

                                        <form class="add__form row" method="post" action="'. BASE_URL .'app/controllers/admin/instructor.php">
                                            <h2 class="form__title">Редактирование инструктора</h2>
                                            <input name="instructor_id" value="'.$id.'" type="hidden">
                                            <input name="user_id" value="'.$user_id.'" type="hidden">
                                            <input name="oldemail" value="'.$email.'" type="hidden">
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
                                                <input name="email" value="'.$email.'" type="email" class="form-control" id="exampleInputEmail" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="exampleInputTel" class="form-label">Номер телефона</label>
                                                <input name="phone" value="'.$phone.'" type="tel" class="form-control" id="exampleInputTel" placeholder="+7(___)___-__-__" required>
                                            </div>
                                            <div class="mb-3">
                                                <div class="row">
                                                    <div class="col">
                                                        <label for="single-select-status" class="form-label">Статус</label>
                                                        <select name="status" class="form-select" id="single-select-status" data-placeholder="" required>
                                                            <option></option>
                                                            <option>Основной состав</option>
                                                            <option>Запасной состав</option>
                                                            <option>Стажировка</option>
                                                            <option>Старший инструктор</option>
                                                        </select>
                                                    </div>
                                                    <div class="col">
                                                        <label for="single-select-certification" class="form-label">Аттестация</label>
                                                        <select name="certification" class="form-select" id="single-select-certification" data-placeholder="" required>
                                                            <option></option>
                                                            <option>Пройдена</option>
                                                            <option>Не пройдена</option>
                                                            <option>Пройдена частично</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-3 password">
                                                <label for="exampleInputPassword" class="form-label">Пароль</label>
                                                <input name="pass" type="password" class="password form-control" id="exampleInputPassword" required>
                                                <i class="bi bi-eye-slash" id="togglePassword"></i>
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
                                        <a class="close" href="instructors.php">&times;</a>
                                        <div class="content">
                                            <h2 class="popup__title">Запись успешно изменена!</h2>
                                            <a href="instructors.php" class="primary__btn added__btn">OK</a>
                                        </div>
                                    </div>
                                </div>';
                            }
                        }elseif($action=='drop'){
                            $email=$_GET["email"];
                            echo '
                            <div id="popup" class="overlay">
                                <div class="popup">
                                    <a class="close" href="instructors.php">&times;</a>
                                    <div class="content">
                                        <div>
                                            <h2 class="popup__title">Вы точно хотите удалить эту запись?</h2>
                                            <h3 class ="popup__subtitle">('.$email.')</h3>
                                        </div>
                                        <div class="popup__buttons">
                                            <a href="'.BASE_URL.'app/controllers/admin/instructor.php?action=drop&id='.$id.'" class="primary__btn delete__btn">Да</a>
                                            <a href="instructors.php" class="primary__btn delete__btn">Нет</a>
                                        </div>
                                    </div>
                                </div>
                            </div>';
                        }
                    }?>
                </div>
            </main>            
        </div>
    </div>
<!-- ---------------   JS   --------------- -->
<script src="../assets/js/libraries/lordicon.js"></script>
<script src="../assets/js/libraries/imask.js"></script>
<script src="../assets/js/libraries/jquery.min.js"></script>
<script src="../assets/js/libraries/select2.min.js"></script>
<script src="../assets/js/animation.js"></script>
<script src="../assets/js/sidebar.js"></script>
<script src="../assets/js/admin/instructors.js"></script>
<!-- -------------   END js   ------------- -->

</body>
</html>