<?php
include "../../path.php";
include SITE_ROOT . "/app/database/db.php"; 

date_default_timezone_set('Europe/Moscow');
$today = date('Y-m-d');

if(!empty($_POST["people"])){
    $stringNumber = $_POST["people"];
    $people = (int)$stringNumber;
    $sql = "SELECT DISTINCT timeslots.date FROM timeslots WHERE remaining_capacity >= '$people' AND timeslots.date >= '$today' ORDER BY timeslots.date ASC";
    $query = $pdo->prepare($sql);
    $query->execute();
    $rowCount = $query->rowCount();
    if($rowCount > 0 && $people > 0){
        echo '<option value=""></option>';
        while($row = $query->fetch()){
            $date = formatData($row['date']);
            $week = formatDataWeek($row['date']);
            echo '<option value="'.$row['date'].'">'.$date.' | '.$week.'</option>';
        }
    }
}

if(!empty($_POST["date"])){
    $date = $_POST["date"];
    $sql = "SELECT * FROM timeslots INNER JOIN services ON timeslots.service_id = services.service_id WHERE timeslots.date = '$date' ORDER BY time_start ASC";
    $query = $pdo->prepare($sql);
    $query->execute();
    $rowCount = $query->rowCount();
    if($rowCount > 0){
        echo '<option value=""></option>';
        while($row = $query->fetch()){
            $time = formatTime($row['time_start']);
            $capacity = $row['remaining_capacity'] . "/" . $row['total_capacity'];
            $service = $row['name'];
            echo '<option value="'.$row['slot_id'].'">'.$time.' | '.$service.' | '.$capacity.'</option>';
        }
    }
}

if(!empty($_POST["slot"])){
    $slot_id = $_POST["slot"];
    $stringNumber = $_POST["number"];
    $number = (int)$stringNumber;;
    $sql = "SELECT instructor_timeslots.instructor_id, instructor_timeslots.remaining_capacity, instructor_timeslots.total_capacity, instructors.instructor_surname, instructors.instructor_name FROM instructor_timeslots INNER JOIN instructors ON instructor_timeslots.instructor_id = instructors.instructor_id WHERE slot_id = '$slot_id' AND remaining_capacity >= '$number' ORDER BY instructor_id ASC"; 
    $query = $pdo->prepare($sql);
    $query->execute();
    $rowCount = $query->rowCount();
    if($rowCount > 0){
        echo '<option value=""></option>';
        echo '<option value="NULL">Любой классный</option>';
        while($row = $query->fetch()){
            $fullName = $row['instructor_surname'] . " " . $row['instructor_name'];
            $icapacity = $row['remaining_capacity'] . "/" . $row['total_capacity'];
            echo '<option value="'.$row['instructor_id'].'">'.$fullName.' | '.$icapacity.'</option>';
        }
    }else{
        $value = null;
        echo '<option value="NULL">Любой классный</option>';
    }
}
