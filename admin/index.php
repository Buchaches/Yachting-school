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
    <title>Админ панель</title>
    
    <!-- -------------   CSS   ------------- -->
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

                <h1 class="header__title">Статистика</h1>

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
                    <div class="statistics">
                        <div class="statistics__group">
                            <div class="statistics__item first element-animation ">
                                <div class="item__text">
                                    <div class="item__count"><?=$instructors = countRows('instructors') ?></div>
                                    <div class="item__title">Инструкторов</div>
                                </div>
                                <div class="item__icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="#1a1a1a" height="40" viewBox="0 -960 960 960" width="40"><path d="M160-160v-280 280Zm640 0v-280 280Zm-40-480q17 0 28.5-11.5T800-680q0-17-11.5-28.5T760-720q-17 0-28.5 11.5T720-680q0 17 11.5 28.5T760-640Zm0 80q-51 0-85.5-34.5T640-680q0-50 34.5-85t85.5-35q50 0 85 35t35 85q0 51-35 85.5T760-560ZM480-680q25 0 42.5-17t17.5-43q0-25-17.5-42.5T480-800q-26 0-43 17.5T420-740q0 26 17 43t43 17Zm0 80q-59 0-99.5-40.5T340-740q0-58 40.5-99t99.5-41q58 0 99 41t41 99q0 59-41 99.5T480-600ZM320-425q0 30 32 70t128 127q94-85 127-125t33-72q0-23-15-39t-37-16q-14 0-26.5 6T541-457l-48 57h-27l-48-57q-8-11-20.5-17t-25.5-6q-23 0-37.5 16T320-425Zm-80 0q0-53 36-94t96-41q31 0 59.5 14t48.5 38q20-24 48-38t60-14q60 0 96 41.5t36 93.5q0 53-38.5 104.5T524-160l-44 40-44-40Q315-270 277.5-321T240-425Zm-40-215q17 0 28.5-11.5T240-680q0-17-11.5-28.5T200-720q-17 0-28.5 11.5T160-680q0 17 11.5 28.5T200-640ZM483-80v-80h317v-280H682v-80h118q33 0 56.5 23.5T880-440v360H483Zm-323-80h323v80H80v-360q0-33 23-56.5t57-23.5h118v80H160v280Zm40-400q-51 0-85.5-34.5T80-680q0-50 34.5-85t85.5-35q50 0 85 35t35 85q0 51-35 85.5T200-560Zm280-180Zm-280 60Zm560 0Z"/></svg>
                                </div>
                            </div>
                            <div class="statistics__item second element-animation">
                                <div class="item__text">
                                    <div class="item__count"><?=$clients = countRows('clients') ?></div>
                                    <div class="item__title">Клиентов</div>
                                </div>
                                <div class="item__icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="#1a1a1a" height="40" viewBox="0 -960 960 960" width="40"><path d="M360-80v-529q-91-24-145.5-100.5T160-880h80q0 83 53.5 141.5T430-680h100q30 0 56 11t47 32l181 181-56 56-158-158v478h-80v-240h-80v240h-80Zm120-640q-33 0-56.5-23.5T400-800q0-33 23.5-56.5T480-880q33 0 56.5 23.5T560-800q0 33-23.5 56.5T480-720Z"/></svg>
                                </div>
                            </div>
                        </div>
                        <div class="statistics__group">
                            <div class="statistics__item third element-animation">
                                <div class="item__text">
                                    <div class="item__count">6</div>
                                    <div class="item__title">Покупок</div>
                                </div>
                                <div class="item__icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="#1a1a1a" height="40" viewBox="0 -960 960 960" width="40"><path d="M480-80q-75 0-140.5-28.5t-114-77q-48.5-48.5-77-114T120-440q0-75 28.5-140.5t77-114q48.5-48.5 114-77T480-800q75 0 140.5 28.5t114 77q48.5 48.5 77 114T840-440q0 75-28.5 140.5t-77 114q-48.5 48.5-114 77T480-80Zm0-360Zm112 168 56-56-128-128v-184h-80v216l152 152ZM224-866l56 56-170 170-56-56 170-170Zm512 0 170 170-56 56-170-170 56-56ZM480-160q117 0 198.5-81.5T760-440q0-117-81.5-198.5T480-720q-117 0-198.5 81.5T200-440q0 117 81.5 198.5T480-160Z"/></svg>
                                </div>
                            </div>
                            <div class="statistics__item fourth element-animation">
                                <div class="item__text">
                                    <div class="item__count"><?=$timeslots = countRows('timeslots',['date'=>$date]) ?></div>
                                    <div class="item__title">Слотов</div>
                                </div>
                                <div class="item__icon">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="#1a1a1a" height="40" viewBox="0 -960 960 960" width="40"><path d="M200-120v-640q0-33 23.5-56.5T280-840h400q33 0 56.5 23.5T760-760v640L480-240 200-120Zm80-122 200-86 200 86v-518H280v518Zm0-518h400-400Z"/></svg>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="table__wrapper">

                        <div class="table__item element-animation">
                            <div class="table__desc">
                                <div class="desc__title">
                                    Слоты на ближайшие 7 дней
                                </div>
                                <div class="desc__text">
                                    Более подробную информацию можно получить в разделе <a href="timeslots.php" style="color: var(--accent-blue); font-weight:500">@Слоты</a>.
                                </div>
                            </div>
                            <table class="main__table">
                                <thead>
                                    <tr>
                                        <th>Дата</th>
                                        <th>Время</th>
                                        <th>Услуга</th>
                                        <th>Свободных&nbsp;мест</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $sql = "SELECT timeslots.slot_id, services.name, timeslots.date, timeslots.time_start, timeslots.total_capacity,timeslots.remaining_capacity
                                        FROM timeslots
                                        INNER JOIN services ON timeslots.service_id = services.service_id
                                        WHERE timeslots.date BETWEEN '$date' AND '$date' + INTERVAL 7 DAY
                                        ORDER BY timeslots.date,timeslots.time_start DESC";                            
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
                                                "</tr>";
                                            }                                     
                                        } else { 
                                            echo '<tr>
                                            <td colspan="4">
                                            <img src="../assets/img/icon/not_found.svg" width="260px">
                                            </td>
                                            </tr>'; 
                                        }
                                    ?>           
                                </tbody>
                            </table>
                        </div>

                        <div class="table__item element-animation">
                            <div class="table__desc">
                                <div class="desc__title">
                                    Сегодняшние покупки
                                </div>
                                <div class="desc__text">
                                    Более подробную информацию можно получить в разделе <a href="bookings.php" style="color: var(--accent-blue); font-weight:500">@Покупки</a>.
                                </div>
                            </div>
                            <table class="main__table">
                                <thead>
                                    <tr>
                                        <th>Дата</th>
                                        <th>Время</th>
                                        <th>Услуга</th>
                                        <th>Свободных&nbsp;мест</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $sql = "SELECT timeslots.slot_id, services.name, timeslots.date, timeslots.time_start, timeslots.total_capacity,timeslots.remaining_capacity
                                        FROM timeslots
                                        INNER JOIN services ON timeslots.service_id = services.service_id
                                        ORDER BY timeslots.date,timeslots.time_start DESC";                            
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
                                                "</tr>";
                                            }                                     
                                        } else { 
                                            echo '<tr>
                                            <td colspan="4">
                                            <img src="../assets/img/icon/not_found.svg" width="260px">
                                            </td>
                                            </tr>'; 
                                        }
                                    ?>           
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
<!-- ---------------   JS   --------------- -->
<script src="../assets/js/animation.js"></script>
<script src="../assets/js/lordicon.js"></script>
<script src="../assets/js/admin/sidebar.js"></script>
<!-- -------------   END js   ------------- -->

</body>
</html>