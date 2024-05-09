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
    $client_id = $_SESSION['client_id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#fafafa" media="(prefers-color-scheme: light)">
    <meta name="theme-color" content="#fafafa" media="(prefers-color-scheme: dark)">
    <title>Личный кабинет</title>
    
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
                <h1 class="header__title">Главная</h1>
                <div class="header__calendar">
                    <div class="calendar__text">
                        <p class="calendar__title">Today's Date</p>
                        <p class="calendar__date">
                            <?php
                                date_default_timezone_set('Europe/Moscow');
                                $date = date('Y-m-d');
                                $timeNow = date("H:i:s");
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
                    <div class="main__title" style="padding-top:0px;">Статистика</div>
                    <div class="statistics">
                        <div class="statistics__group">
                            <div class="statistics__item client first element-animation">
                                <div class="item__text">
                                    <div class="item__title">Прогулок</div>
                                    <div class="item__count">
                                        <?=$trip=countRowsBookingClients($client_id, 1)?>
                                    </div>
                                </div>
                            </div>
                            <div class="statistics__item client second element-animation">
                                
                                <div class="item__text">
                                    <div class="item__title">Тренировок</div>
                                    <div class="item__count">
                                        <?=$training=countRowsBookingClients($client_id, 2)?>
                                    </div>
                                </div>
                            </div>
                            <div class="statistics__item client third element-animation">
                                <div class="item__text">
                                    <div class="item__title">Регат</div>
                                    <div class="item__count">
                                        <?=$race=countRowsBookingClients($client_id, 3)?>
                                    </div>                                   
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="main__title">Активные покупки</div>
                    <div class="table__container client">
                        <table class="main__table">
                            <thead>
                                <tr>
                                    <th>Дата</th>
                                    <th>Время</th>
                                    <th>Услуга</th>
                                    <th>Инструктор</th>
                                    <th>Мест</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $sql = "SELECT timeslots.date, timeslots.time_start, services.name,  CONCAT(instructors.instructor_surname, ' ', instructors.instructor_name) AS instructor, bookings.booked_capacity
                                    FROM bookings
                                    INNER JOIN timeslots ON bookings.slot_id = timeslots.slot_id
                                    INNER JOIN services ON timeslots.service_id = services.service_id
                                    LEFT JOIN instructors ON bookings.instructor_id = instructors.instructor_id
                                    WHERE bookings.client_id = '$client_id' AND (timeslots.date > '$date' OR (timeslots.date = '$date' AND timeslots.time_start > '$timeNow'))
                                    ORDER BY timeslots.date ASC, timeslots.time_start ASC";                            
                                    $query = $pdo->prepare($sql);
                                    $query->execute();
                                    $rowCount =  $query->rowCount();
                                    if($rowCount > 0){
                                        while ($row =  $query->fetch()) {
                                            $formatDate = formatData($row['date']);
                                            $time_start = formatTime($row['time_start']);

                                            echo "<tr>" .
                                            "<td style='font-size:18px; font-weight:800; color: var(--accent-blue); white-space: nowrap;'>" . $formatDate . "</td>" .
                                            "<td>" . $time_start . "</td>" .
                                            "<td>" . $row['name'] . "</td>" .
                                            "<td>" . $row['instructor'] . "</td>" .
                                            "<td style='font-size: 20px; font-weight: 800; color: var(--accent-blue);'>" . $row['booked_capacity'] . "</td>" .
                                            "</tr>";
                                        }                                     
                                    } else { 
                                        echo '<tr>
                                        <td colspan="5">
                                        <img src="./../assets/img/icon/not_found.svg" width="260px">
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
<script src="../assets/js/libraries/lordicon.js"></script>
<script src="../assets/js/sidebar.js"></script>
<!-- -------------   END js   ------------- -->

</body>
</html>