<?php
include "../../path.php";
include SITE_ROOT . "/app/database/db.php"; 

date_default_timezone_set('Europe/Moscow');
$today = date('Y-m-d');

if(!empty($_POST["people"])){
    $stringNumber = $_POST["people"];
    $people = (int)$stringNumber;
    $sql = "SELECT * FROM timeslots WHERE remaining_capacity >= '$people' AND timeslots.date >= '$today' ORDER BY timeslots.date ASC";
    $query = $pdo->prepare($sql);
    $query->execute();
    $rowCount = $query->rowCount();
    if($rowCount > 0 && $people > 0){
        while($row = $query->fetch()){
            $date = formatData($row['date']);
            $week = formatDataWeek($row['date']);
            echo '<option value="'.$row['slot_id'].'">'.$date.' | '.$week.'</option>';
        }
    }else{
        echo '<option value="">Укажите количество человек</option>';
    }
}
