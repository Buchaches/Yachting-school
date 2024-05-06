<?php 
    include "./../path.php";
    include "./../app/database/db.php"; 
?>
<?php 
    if(isset($_SESSION['email'])){
        if($_SESSION["email"] == "" or $_SESSION['role_id']!='2'){
            header('location:' . BASE_URL. 'login.php');
        }
    }else{
        header('location:' . BASE_URL . 'login.php');
    }
    $instructor_id = $_SESSION['instructor_id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#fafafa" media="(prefers-color-scheme: light)">
    <meta name="theme-color" content="#fafafa" media="(prefers-color-scheme: dark)">
    <title>Инструкторская - Слоты</title>
    
    <!-- -------------   CSS   ------------- -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
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
        <?php include("../app/include/instructor_sidebar.php"); ?>
        <div class="body">
            <header class="header">
                <button id="sidebar-btn" class="sidebar-btn">
                    <img id="sidebar-btn-img" src="./../assets/img/icon/sidebar_menu/sidebar-open.svg" alt="Nav button">
                </button>   
                <h1 class="header__title">Слоты</h1>
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
                    <div class="row__counter">Всего слотов&nbsp;(<?=$totalClients = countRows("bookings",['instructor_id'=>$_SESSION['instructor_id']])?>)</div>
                    <form method="post" class="filter__form" action="bookings.php">
                        <div class="filter__row">
                            <div class="filter__col">
                                <label for="exampleInputDate" class="filter__label">Дата</label>
                                <input name="date" type="date" class="form-control filter__control">
                            </div>
                            <div class="filter__col">
                                <label for="filterService" class="filter__label">Программа</label>
                                <select name="service" class="form-select" id="filterService" style="width: 270px" data-placeholder="Выберите услугу">
                                    <option></option>
                                    <?php 
                                    $services = selectAll('services');
                                    foreach($services as $key => $service):?>
                                        <option><?=$service['name']?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="filter__col">
                                <button type="submit" class="primary__btn filter__btn client" name="filter__btn"><div><svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="24px" viewBox="0 0 24 24" width="24px" fill="#FFFFFF"><g><path d="M0,0h24 M24,24H0" fill="none"/><path d="M7,6h10l-5.01,6.3L7,6z M4.25,5.61C6.27,8.2,10,13,10,13v6c0,0.55,0.45,1,1,1h2c0.55,0,1-0.45,1-1v-6 c0,0,3.72-4.8,5.74-7.39C20.25,4.95,19.78,4,18.95,4H5.04C4.21,4,3.74,4.95,4.25,5.61z"/><path d="M0,0h24v24H0V0z" fill="none"/></g></svg></svg>Filter</div></button>
                            </div>
                        </div>
                    </form>                   
                    <div class="table__container">
                        <table class="main__table">
                            <thead>
                                <tr>
                                    <th>Дата</th>
                                    <th>Время</th>
                                    <th>Услуга</th>
                                    <th>Клиент</th>
                                    <th>Мест</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['filter__btn'])){
                                        $sqlpt1 = "";
                                        if(!empty($_POST["date"])) {
                                            $filterDate = $_POST["date"];
                                            $sqlpt1 = "timeslots.date = '$filterDate'";
                                        }
                                    
                                        $sqlpt2 = "";
                                        if(!empty($_POST["service"])) {
                                            $service = $_POST["service"];
                                            $sqlpt2 = "services.name = '$service'";
                                        }

                                        $sql = "SELECT timeslots.date, timeslots.time_start, services.name, CONCAT(clients.client_surname ,' ', clients.client_name) AS client, bookings.booked_capacity, bookings.timestamp, bookings.status
                                        FROM bookings
                                        INNER JOIN timeslots ON bookings.slot_id = timeslots.slot_id
                                        INNER JOIN services ON timeslots.service_id = services.service_id
                                        INNER JOIN clients ON bookings.client_id = clients.client_id
                                        WHERE bookings.instructor_id = '$instructor_id'";
                                        $sqllist = array($sqlpt1, $sqlpt2);
                                        foreach($sqllist as $key) {
                                            if(!empty($key)) {
                                                $sql .= " AND " . $key;
                                            }
                                        };
                                        $sql .= " ORDER BY timeslots.date ASC, timeslots.time_start ASC";
                                    }else{
                                        $sql = "SELECT timeslots.date, timeslots.time_start, services.name,  CONCAT(clients.client_surname ,' ', clients.client_name) AS client, bookings.booked_capacity, bookings.timestamp, bookings.status
                                        FROM bookings
                                        INNER JOIN timeslots ON bookings.slot_id = timeslots.slot_id
                                        INNER JOIN services ON timeslots.service_id = services.service_id
                                        INNER JOIN clients ON bookings.client_id = clients.client_id
                                        WHERE bookings.instructor_id = '$instructor_id'
                                        ORDER BY timeslots.date ASC, timeslots.time_start ASC"; 
                                    }                      
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
                                            "<td>" . $row['client'] . "</td>" .
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
<script src="../assets/js/libraries/lordicon.js"></script>
<script src="../assets/js/libraries/jquery.min.js"></script>
<script src="../assets/js/libraries/select2.min.js"></script>
<script src="../assets/js/sidebar.js"></script>
<script src="../assets/js/instructor/bookings.js"></script>
<!-- -------------   END js   ------------- -->

</body>
</html>