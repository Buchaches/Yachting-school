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
    $sql = "SELECT DISTINCT time_start FROM timeslots WHERE timeslots.date = '$date' ORDER BY time_start ASC"; //Поменять на вывод всего
    $query = $pdo->prepare($sql);
    $query->execute();
    $rowCount = $query->rowCount();
    if($rowCount > 0){
        echo '<option value=""></option>';
        while($row = $query->fetch()){
            $time = formatTime($row['time_start']);
            echo '<option value="'.$row['time_start'].'">'.$time.'</option>';
        }
    }
}