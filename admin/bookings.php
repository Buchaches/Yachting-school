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
    <title>Админ панель - Покупки</title>
    
    <!-- -------------   CSS   ------------- -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
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
                <h1 class="header__title">Покупки</h1>
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
                                <input name="date" type="date" class="form-control filter__control" id="exampleInputDate">
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
                                    $rowCount =  $query->rowCount();
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
<script src="../assets/js/admin/bookings.js"></script>
<!-- -------------   END js   ------------- -->

</body>
</html>