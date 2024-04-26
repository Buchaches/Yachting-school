<?php 
    include "../path.php";
    include "../app/database/db.php";
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
    <link rel="stylesheet" href="../assets/css/admin.css">
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
    <div class="dashboard">
        <?php include("../app/include/admin_sidebar.php"); ?>
        <div class="body">
            <header class="header">                
                <h1 class="header__title">Слоты</h1>
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
                        <div class="add__text">Добавить новый слот</div>
                        <a href="?action=add&id=none&error=0" class="admin__btn add__btn"><div><svg xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 0 24 24" width="20px" fill="#FFFFFF"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"/></svg>Add New</div></a>
                    </div>
                    <div class="row__counter">Всего слотов&nbsp;(<?=$totalClients = countRows("instructors")?>)</div>
                    <form method="post" class="filter__form" action="">
                        <div class="filter__row">
                            <div class="filter__col">
                                <label for="exampleInputDate" class="filter__label">Дата</label>
                                <input name="date" type="date" class="form-control filter__control">
                            </div>
                            <div class="filter__col">
                                <label for="filterInstructors" class="filter__label">Инструктор</label>
                                <select name="instructor" class="form-select" id="filterInstructors" style="width: 300px" data-placeholder="Выберите инструктора">
                                    <option></option>
                                    <?php 
                                    $instructors = selectAll('instructors');
                                    foreach($instructors as $key => $instructor):?>
                                        <option value="<?=$instructor['instructor_id']?>"><?=$instructor['instructor_surname'] . " " . $instructor['instructor_name']?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="filter__col">
                                <button type="submit" class="admin__btn filter__btn" name="filter__btn"><div><svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="24px" viewBox="0 0 24 24" width="24px" fill="#FFFFFF"><g><path d="M0,0h24 M24,24H0" fill="none"/><path d="M7,6h10l-5.01,6.3L7,6z M4.25,5.61C6.27,8.2,10,13,10,13v6c0,0.55,0.45,1,1,1h2c0.55,0,1-0.45,1-1v-6 c0,0,3.72-4.8,5.74-7.39C20.25,4.95,19.78,4,18.95,4H5.04C4.21,4,3.74,4.95,4.25,5.61z"/><path d="M0,0h24v24H0V0z" fill="none"/></g></svg></svg>Filter</div></button>
                            </div>
                        </div>
                    </form>                                
                    <div class="table__container element-animation">
                        <table class="main__table">
                            <thead>
                                <tr>
                                    <th>Дата</th>
                                    <th>Время</th>
                                    <th>Услуга</th>
                                    <th>Свободных&nbsp;мест</th>
                                    <th>Управление</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['filter__btn'])){
                                        $sqlpt1 = "";
                                        if(!empty($_POST["date"])) {
                                            $filterDate = $_POST["date"];
                                            $sqlpt1 = "timeslots.date ='$filterDate'";
                                        }
                                    
                                        $sqlpt2 = "";
                                        if(!empty($_POST["instructor"])) {
                                            $instructor_id = $_POST["instructor"];
                                            $sqlpt2 = "instructors.instructor_id = '$instructor_id'";
                                        }
                                    
                                        $sql = "SELECT timeslots.slot_id, services.name, timeslots.date, timeslots.time_start, timeslots.total_capacity,timeslots.remaining_capacity,GROUP_CONCAT(CONCAT(instructors.instructor_surname, ' ', instructors.instructor_name) SEPARATOR ', ') AS instructors_list
                                        FROM timeslots
                                        INNER JOIN services ON timeslots.service_id = services.service_id
                                        INNER JOIN instructor_timeslots ON timeslots.slot_id = instructor_timeslots.slot_id
                                        LEFT JOIN instructors ON instructor_timeslots.instructor_id = instructors.instructor_id";

                                        $sqllist = array($sqlpt1, $sqlpt2);
                                        $sqlkeywords = array(" WHERE "," AND ");
                                        $key2 = 0;
                                        foreach($sqllist as $key) {
                                            if(!empty($key)) {
                                                $sql .= $sqlkeywords[$key2] . $key;
                                                $key2++;
                                            }
                                        };
                                        $sql .= " GROUP BY timeslots.slot_id ORDER BY timeslots.date,timeslots.time_start DESC";
                                    }else{
                                        $sql = "SELECT timeslots.slot_id, services.name, timeslots.date, timeslots.time_start, timeslots.total_capacity,timeslots.remaining_capacity
                                        FROM timeslots
                                        INNER JOIN services ON timeslots.service_id = services.service_id
                                        ORDER BY timeslots.date,timeslots.time_start DESC";                            
                                    }
                                    $query = $pdo->prepare($sql);
                                    $query->execute();
                                    $rowCount = $query->rowCount();
                                    if($rowCount > 0){
                                        while ($row =  $query->fetch()) {
                                            $date = formatData($row['date']);
                                            $time_start = formatTime($row['time_start']);
                                            $capacity = $row['remaining_capacity'] . '/' . $row['total_capacity'];

                                            echo "<tr>" .
                                            "<td style='font-size:18px; font-weight:800; color: var(--accent-blue); white-space: nowrap;'>" . $date . "</td>" .
                                            "<td>" . $time_start . "</td>" .
                                            "<td>" . $row['name'] . "</td>" .
                                            "<td style='font-size:18px; font-weight:800; color: var(--accent-blue);'>" . $capacity . "</td>" .
                                            "<td>
                                            <div class='controls__wrapper'>
                                            <a href='?action=view&id=".$row['slot_id']."' class='control__btn'>
                                            <div><svg class='control__icon' xmlns='http://www.w3.org/2000/svg' height='24px' viewBox='0 0 24 24' width='24px'><path d='M0 0h24v24H0V0z' fill='none'/><path d='M12 6c3.79 0 7.17 2.13 8.82 5.5C19.17 14.87 15.79 17 12 17s-7.17-2.13-8.82-5.5C4.83 8.13 8.21 6 12 6m0-2C7 4 2.73 7.11 1 11.5 2.73 15.89 7 19 12 19s9.27-3.11 11-7.5C21.27 7.11 17 4 12 4zm0 5c1.38 0 2.5 1.12 2.5 2.5S13.38 14 12 14s-2.5-1.12-2.5-2.5S10.62 9 12 9m0-2c-2.48 0-4.5 2.02-4.5 4.5S9.52 16 12 16s4.5-2.02 4.5-4.5S14.48 7 12 7z'/></svg>View</div></a>
                                            <a href='?action=edit&id=".$row['slot_id']."&error=0' class='control__btn'>
                                            <div><svg class='control__icon' xmlns='http://www.w3.org/2000/svg' height='24px' viewBox='0 0 24 24' width='24px'><path d='M0 0h24v24H0V0z' fill='none'/><path d='M14.06 9.02l.92.92L5.92 19H5v-.92l9.06-9.06M17.66 3c-.25 0-.51.1-.7.29l-1.83 1.83 3.75 3.75 1.83-1.83c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.2-.2-.45-.29-.71-.29zm-3.6 3.19L3 17.25V21h3.75L17.81 9.94l-3.75-3.75z'/></svg>Edit</div></a>
                                            <a href='?action=drop&id=".$row['slot_id']."&date=".$row['date']."&time=".$time_start."' class='control__btn'>
                                            <div><svg class='control__icon' xmlns='http://www.w3.org/2000/svg' height='24px' viewBox='0 0 24 24' width='24px'><path d='M0 0h24v24H0V0z' fill='none'/><path d='M16 9v10H8V9h8m-1.5-6h-5l-1 1H5v2h14V4h-3.5l-1-1zM18 7H6v12c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7z'/></svg>Delete</div></a>
                                            </div>
                                            </td>" .
                                            "</tr>";
                                        }                                     
                                    } else { 
                                        echo '<tr>
                                        <td colspan="5">
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

                        if($action=='view'){
                            $timeslots = "SELECT timeslots.slot_id, services.name, services.price, timeslots.date, timeslots.time_start, timeslots.total_capacity,timeslots.remaining_capacity
                            FROM timeslots
                            INNER JOIN services ON timeslots.service_id = services.service_id
                            WHERE timeslots.slot_id = $id";
                            $result= $pdo->query($timeslots);
                            $row=$result->fetch();

                            $service_name = $row["name"];
                            $services_price = $row["price"];
                            $date = formatData($row['date']);
                            $time_start = formatTime($row['time_start']);
                            $capacity = $row['remaining_capacity'] . '/' . $row['total_capacity'];

                            $instructors = "SELECT instructor_timeslots.slot_id, instructor_timeslots.total_capacity, instructor_timeslots.remaining_capacity, instructors.instructor_surname, instructors.instructor_name 
                            FROM instructor_timeslots
                            JOIN instructors ON instructor_timeslots.instructor_id = instructors.instructor_id
                            WHERE instructor_timeslots.slot_id = $id
                            ORDER BY instructors.instructor_surname ASC";
                            $query = $pdo->prepare($instructors);
                            $query->execute();
                            $rowCount = $query->rowCount();

                            echo '
                            <div id="popup" class="overlay">
                                <div class="popup">
                                    <a class="close" href="timeslots.php">&times;</a>
                                    <div class="content" style="padding:0 20px 20px;">
                                        <div class="content_section">
                                            <div class="section__container">
                                                <p class="content__title">Услуга:</p>
                                                <p class="content__text" style="font-size:17px; font-weight:700; color: var(--accent-blue);">'.$service_name.'</p>
                                            </div>
                                            <br>
                                            <div class="section__container">
                                                <p class="content__title">Цена:</p>
                                                <p class="content__text" style="font-size:17px; font-weight:700; color: var(--accent-blue);">'.$services_price.'р</p>
                                            </div>
                                        </div>
                                        <div class="content_section date_time">
                                            <div class="section__container">
                                                <p class="content__title">Дата:</p>
                                                <p class="content__text" style="font-size:17px; font-weight:700; color: var(--accent-blue); white-space: nowrap;">'.$date.'</p>
                                            </div>
                                            <div class="section__container">
                                                <p class="content__title">Время:</p>
                                                <p class="content__text" style="font-size:17px; font-weight:700; color: var(--accent-blue);">'.$time_start.'</p>
                                            </div>
                                        </div>
                                        <div class="content_section capacity">
                                            <p class="content__title">Свободных мест:</p>
                                            <p class="content__text" style="font-size:17px; font-weight:700; color: var(--accent-blue);">'.$capacity.'</p>
                                        </div>
                                        <div class="content_section">
                                            <p class="content__title">Инструкторы:</p>
                                            <br>
                                            <div class="table__container" style="max-height: 284px; overflow-y: auto;">
                                                <table class="main__table element-animation">
                                                    <thead>
                                                        <tr>
                                                            <th>Имя инструктора</th>
                                                            <th>Свободных&nbsp;мест</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>';

                                                        if($rowCount == 0){
                                                            echo '<tr>
                                                            <td colspan="2">
                                                            <img src="../assets/img/icon/not_found.svg" width="200px">
                                                            </td>
                                                            </tr>'; 
                                                        }else{
                                                            while ($row = $query->fetch()){
                                                                $surname = $row['instructor_surname'];
                                                                $name= $row['instructor_name'];
                                                                $capacity = $row['remaining_capacity'] . '/' . $row['total_capacity'];
                                                                echo '<tr>
                                                                <td style="white-space: nowrap;">'.$surname.' '.$name.'</td>
                                                                <td style="font-size:17px; font-weight:700; color: var(--accent-blue);">'.$capacity.'</td>
                                                                </tr>';
                                                                
                                                            }
                                                        }

                                                    echo'</tbody>
                                                </table>
                                            </div>
                                        </div>    
                                    </div>
                                </div>
                            </div>';

                        }else if($action=='add'){
                            $errorGet=$_GET["error"];
                            $errorlist= array(
                                '1'=>'Не все поля заполнены!',
                                '2'=>'Добавьте больше инструкторов!',
                                '3'=>'Укажите другую дату или время или уменьшите кол-во яхт!',
                                '4'=>'',
                                '0'=>'',
                            );
                            if($errorGet!= '4'){
                                echo '
                                <div id="popup" class="overlay">
                                    <div class="popup">
                                        <a class="close" href="timeslots.php">&times;</a>

                                        <form class="add__form row" method="post" action="'. BASE_URL .'app/controllers/admin/timeslot.php">
                                            <h2 class="form__title">Создание слота</h2>
                                            <div class="mb-3">
                                                <label for="exampleInputService" class="form-label">Программа обучения</label>
                                                <select name="service" class="form-select" id="exampleInputService" data-placeholder="Выберите услугу" required>
                                                    <option></option>';
                                                    $services = selectAll('services');
                                                    foreach($services as $key => $service){
                                                        echo'<option>'.$service["name"].'</option>';
                                                    }
                                                echo '    
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <div class="row mb-3">
                                                    <div class="col">
                                                        <label for="exampleInputDate" class="form-label">Дата</label>
                                                        <input name="date" type="date" class="form-control" id="exampleInputDate" required>
                                                    </div>
                                                    <div class="col">
                                                        <label for="exampleInputTime" class="form-label">Время</label>
                                                        <input name="time_start" type="time" class="form-control" id="exampleInputTime" required>
                                                    </div>
                                                </div>    
                                            </div>
                                            <div class="mb-3">
                                                <div class="row align-items-center">
                                                    <div class="col-auto">
                                                        <label for="exampleInputYachts" class="form-label">Количество яхт:</label>
                                                    </div>
                                                    <div class="col-2">
                                                        <input name="number" type="number" class="form-control" id="exampleInputYachts" value="1" min="1" max="6" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="exampleInputInstructors" class="form-label">Инструкторы</label>
                                                <select name="instructors[]" class="form-select" id="exampleInputInstructors" data-placeholder="Выберите инструктора" multiple required>
                                                    <option></option>';
                                                    $instructors = selectAll('instructors');
                                                    foreach($instructors as $key => $instructor){
                                                        echo '<option value="'.$instructor['instructor_id'].'">'.$instructor['instructor_surname'].' '.$instructor['instructor_name'].'</option>';
                                                    }
                                                echo '
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <p class="form__err">'.$errorlist[$errorGet].'</p>
                                            </div>
                                            <div class="mb-3">
                                                <button type="submit" class="submit__btn btn btn-secondary" name="add__btn">Создать</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>';
                            }else{
                                echo '
                                <div id="popup" class="overlay">
                                    <div class="popup">
                                        <a class="close" href="timeslots.php">&times;</a>
                                        <div class="content">
                                            <h2 class="popup__title">Новый слот успешно создан!</h2>
                                            <a href="timeslots.php" class="admin__btn added__btn">OK</a>
                                        </div>
                                    </div>
                                </div>';
                            }
                        }else if($action=='edit'){
                            $errorGet=$_GET["error"];
                            $errorlist= array(
                                '1'=>'Не все поля заполнены!',
                                '2'=>'Добавьте больше инструкторов!',
                                '3'=>'Укажите другую дату или время или уменьшите кол-во яхт!',
                                '4'=>'',
                                '0'=>'',
                            );

                            $timeslots = selectOne('timeslots',['slot_id' => $id]);
                            $date = $timeslots['date'];
                            $time_start = $timeslots['time_start'];
                            $time_start = formatTime($time_start);
                            $total_capacity = $timeslots['total_capacity'];
                            $yachts_number = $total_capacity / 4;

                            $instructors = "SELECT instructor_timeslots.id,instructor_timeslots.slot_id, instructor_timeslots.total_capacity, instructor_timeslots.remaining_capacity, instructors.instructor_surname, instructors.instructor_name 
                            FROM instructor_timeslots
                            JOIN instructors ON instructor_timeslots.instructor_id = instructors.instructor_id
                            WHERE instructor_timeslots.slot_id = $id
                            ORDER BY instructors.instructor_surname ASC";
                            $query = $pdo->prepare($instructors);
                            $query->execute();
                            $rowCount = $query->rowCount();

                            if($errorGet!= '4'){
                                echo '
                                <div id="popup" class="overlay">
                                    <div class="popup">
                                        <a class="close" href="timeslots.php">&times;</a>

                                        <form class="add__form row" method="post" action="'. BASE_URL .'app/controllers/admin/timeslot.php">
                                            <h2 class="form__title">Редактирование слота</h2>
                                            <input name="slot_id" value="'.$id.'" type="hidden">
                                            <input name="old_number" value="'.$yachts_number.'" type="hidden">
                                            <div class="mb-3">
                                                <label for="exampleInputService" class="form-label">Программа обучения</label>
                                                <select name="service" class="form-select" id="exampleInputService" data-placeholder="Выберите услугу" required>
                                                    <option></option>';
                                                    $services = selectAll('services');
                                                    foreach($services as $key => $service){
                                                        echo'<option>'.$service["name"].'</option>';
                                                    }
                                                echo '    
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <div class="row">
                                                    <div class="col">
                                                        <label for="exampleInputDate" class="form-label">Дата</label>
                                                        <input name="date" type="date" value="'.$date.'" class="form-control" id="exampleInputDate" required>
                                                    </div>
                                                    <div class="col">
                                                        <label for="exampleInputTime" class="form-label">Время</label>
                                                        <input name="time_start" type="time" value="'.$time_start.'" class="form-control" id="exampleInputTime" required>
                                                    </div>
                                                </div>    
                                            </div>
                                            <div class="mb-3">
                                                <div class="row align-items-center">
                                                    <div class="col-auto">
                                                        <label for="exampleInputYachts" class="form-label" style="margin-bottom: 0;">Количество яхт:</label>
                                                    </div>
                                                    <div class="col-2">
                                                        <input name="number" type="number" value="'.$yachts_number.'" class="form-control" id="exampleInputYachts" value="1" min="1" max="6" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <div class="table__container" style="max-height: 204px; overflow-y: auto;">
                                                    <table class="main__table element-animation">
                                                        <thead>
                                                            <tr>
                                                                <th>Имя инструктора</th>
                                                                <th>Свободных&nbsp;мест</th>
                                                                <th>Редактировать</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>';

                                                            if($rowCount == 0){
                                                                echo '<tr>
                                                                <td colspan="3">
                                                                <img src="../assets/img/icon/not_found.svg" width="200px">
                                                                </td>
                                                                </tr>'; 
                                                            }else{
                                                                while ($row = $query->fetch()){
                                                                    $surname = $row['instructor_surname'];
                                                                    $name= $row['instructor_name'];
                                                                    $capacity = $row['remaining_capacity'] . '/' . $row['total_capacity'];
                                                                    echo '<tr>
                                                                    <td style="white-space: nowrap;">'.$surname.' '.$name.'</td>
                                                                    <td style="font-size:17px; font-weight:700; color: var(--accent-blue);">'.$capacity.'</td>';
                                                                    if($row['remaining_capacity']== 4){
                                                                        echo'<td><a class="control__btn" style="padding: 5px;" href="?action=instructor-drop&id='.$row["id"].'&slot='.$row["slot_id"].'">Удалить</a></td></tr>';
                                                                    }else{
                                                                        echo'<td></td></tr>';
                                                                    }
                                                                }
                                                            }
                                                        echo'</tbody>
                                                    </table>
                                                </div>
                                            </div>    
                                            <div class="mb-3">
                                                <label for="exampleInputInstructors" class="form-label">Добавить инструктора</label>
                                                <select name="instructors[]" class="form-select" id="exampleInputInstructors" data-placeholder="Выберите инструктора" multiple>
                                                    <option></option>';

                                                    $sql = "SELECT * FROM instructors WHERE instructor_id NOT IN ( SELECT instructor_id FROM instructor_timeslots WHERE slot_id = $id )";
                                                    $query = $pdo->prepare($sql);
                                                    $query->execute();
                                                    $instructors = $query->fetchAll();
                                                    foreach($instructors as $key => $instructor){
                                                        echo '<option value="'.$instructor['instructor_id'].'">'.$instructor['instructor_surname'].' '.$instructor['instructor_name'].'</option>';
                                                    }
                                                echo '
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <p class="form__err">'.$errorlist[$errorGet].'</p>
                                            </div>
                                            <div class="mb-3">
                                                <button type="submit" class="submit__btn btn btn-secondary" name="edit__btn">Изменить</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>';
                            }else{
                                echo '
                                <div id="popup" class="overlay">
                                    <div class="popup">
                                        <a class="close" href="timeslots.php">&times;</a>
                                        <div class="content">
                                            <h2 class="popup__title">Слот успешно изменён!</h2>
                                            <a href="timeslots.php" class="admin__btn added__btn">OK</a>
                                        </div>
                                    </div>
                                </div>';
                            }
                        }else if($action=='drop'){
                            $date= formatData($_GET["date"]);
                            $time=$_GET["time"];
                            echo '
                            <div id="popup" class="overlay">
                                <div class="popup">
                                    <a class="close" href="timeslots.php">&times;</a>
                                    <div class="content">
                                        <div>
                                            <h2 class="popup__title">Вы точно хотите удалить этот слот?</h2>
                                            <h3 class ="popup__subtitle"><strong>Дата: </strong>'.$date.'<br><strong> Время: </strong>'.$time.'</h3>
                                        </div>
                                        <div class="popup__buttons">
                                            <a href="'.BASE_URL.'app/controllers/admin/timeslot.php?action=drop&id='.$id.'" class="admin__btn delete__btn">Да</a>
                                            <a href="timeslots.php" class="admin__btn delete__btn">Нет</a>
                                        </div>
                                    </div>
                                </div>
                            </div>';
                        }else if($action=='instructor-drop'){
                            $slot_id =$_GET["slot"];
                            echo '
                            <div id="popup" class="overlay">
                                <div class="popup">
                                    <a class="close" href="timeslots.php?action=edit&id='.$slot_id.'&error=0">&times;</a>
                                    <div class="content">
                                        <div>
                                            <h2 class="popup__title">Вы точно хотите убрать этого инструктора?</h2>
                                        </div>
                                        <div class="popup__buttons">
                                            <a href="'.BASE_URL.'app/controllers/admin/timeslot.php?action=instructor-drop&id='.$id.'&slot='.$slot_id.'" class="admin__btn delete__btn">Да</a>
                                            <a href="timeslots.php?action=edit&id='.$slot_id.'&error=0" class="admin__btn delete__btn">Нет</a>
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
<script src="../assets/js/animation.js"></script>
<script src="../assets/js/lordicon.js"></script>
<script src="../assets/js/admin/sidebar.js"></script>
<script src="../assets/js/jquery.min.js"></script>
<script src="../assets/js/select2.min.js"></script>
<script src="../assets/js/admin/timeslots.js"></script>
<!-- -------------   END js   ------------- -->

</body>
</html>