<?php

use YooKassa\Client;

include "../../path.php";
include SITE_ROOT . "/app/database/db.php"; 
require SITE_ROOT . '/vendor/autoload.php';

date_default_timezone_set('Europe/Moscow');
$today = date('Y-m-d');
$timeNow = date("H:i:s");

// Обработка AJAX запроса
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

if(!empty($_POST["date"]) && !empty($_POST["number"])){
    $date = $_POST["date"];
    $stringNumber = $_POST["number"];
    $number = (int)$stringNumber;
    $sql = "SELECT * FROM timeslots INNER JOIN services ON timeslots.service_id = services.service_id WHERE timeslots.date = '$date' AND timeslots.remaining_capacity >= '$number' AND (timeslots.date > '$today' OR (timeslots.date = '$today' AND timeslots.time_start >= '$timeNow')) ORDER BY time_start ASC";
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

if(!empty($_POST["slot"]) && !empty($_POST["number"])){
    $slot_id = $_POST["slot"];
    $stringNumber = $_POST["number"];
    $number = (int)$stringNumber;
    $sql = "SELECT instructor_timeslots.instructor_id, instructor_timeslots.remaining_capacity, instructor_timeslots.total_capacity, instructors.instructor_surname, instructors.instructor_name FROM instructor_timeslots INNER JOIN instructors ON instructor_timeslots.instructor_id = instructors.instructor_id WHERE slot_id = '$slot_id' AND remaining_capacity >= '$number' ORDER BY instructor_id ASC"; 
    $query = $pdo->prepare($sql);
    $query->execute();
    $rowCount = $query->rowCount();
    if($rowCount > 0){
        echo '<option value="0">Любой классный</option>';
        while($row = $query->fetch()){
            $fullName = $row['instructor_surname'] . " " . $row['instructor_name'];
            $icapacity = $row['remaining_capacity'] . "/" . $row['total_capacity'];
            echo '<option value="'.$row['instructor_id'].'">'.$fullName.' | '.$icapacity.'</option>';
        }
    }else{
        echo '<option value="0">Любой классный</option>';
    }
}

if(!empty($_POST["slotPrice"]) && !empty($_POST["numberPrice"])){
    $slot_id = $_POST["slotPrice"];
    $stringNumber = $_POST["numberPrice"];
    $number = (int)$stringNumber;
    $sql = "SELECT services.price FROM timeslots INNER JOIN services ON timeslots.service_id = services.service_id WHERE slot_id = '$slot_id'"; 
    $query = $pdo->prepare($sql);
    $query->execute();
    $rowCount = $query->rowCount();
    $result = $query->fetch();
    $price = $result['price'];
    $totalPrice = (int)$price * $number;
    if($rowCount > 0){
        echo '' . $totalPrice . ' ₽';
    }else{
        echo '';
    }
}

// Обработка формы бронирования
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['booking__btn'])){
    $client_id = $_POST["client"];
    $instructor_id = $_POST["instructor"];
    $capacity = $_POST["capacity"];
    $slot_id = $_POST["slot"];

    $sql = "SELECT services.price FROM timeslots INNER JOIN services ON timeslots.service_id = services.service_id WHERE slot_id = '$slot_id'"; 
    $query = $pdo->prepare($sql);
    $query->execute();
    $result = $query->fetch();
    $servicePrice = $result['price'];
    $price = (int)$servicePrice * $capacity;

    if ($client_id !='0' && $instructor_id !='0'){
        $post_bookings = [
            "client_id" => $client_id,
            "slot_id" => $slot_id,
            "instructor_id" => $instructor_id,
            "booked_capacity" => $capacity
        ];
    } elseif ($client_id =='0' && $instructor_id !='0'){
        $post_bookings = [
            "slot_id" => $slot_id,
            "instructor_id" => $instructor_id,
            "booked_capacity" => $capacity
        ];
    } elseif ($instructor_id =='0' && $client_id !='0'){
        $post_bookings = [
            "client_id" => $client_id,
            "slot_id" => $slot_id,
            "booked_capacity" => $capacity
        ];
    } else {
        $post_bookings = [
            "slot_id" => $slot_id,
            "booked_capacity" => $capacity
        ];
    }
    $booking_id = insert("bookings",$post_bookings);

    $client = new Client();
    $client->setAuth(SHOP_ID, API_KEY);
    try {
        $idempotenceKey = uniqid('', true);
        $response = $client->createPayment(
            array(
                'amount' => array(
                    'value' => $price,
                    'currency' => 'RUB',
                ),
                'confirmation' => array(
                    'type' => 'redirect',
                    'return_url' => SUCCESS_URL,
                ),
                'capture' => true,
                'description' => 'Заказ №' . $booking_id,
                'metadata' => array(
                    'orderNumber' => $booking_id,
                    'capacity' => $capacity,
                    'instructor' => $instructor_id,
                    'client' => $client_id,
                    'slot' => $slot_id
                ),
            ),
            $idempotenceKey
        );
        $confirmationUrl = $response->getConfirmation()->getConfirmationUrl();
        header("Location: " . $confirmationUrl);
        die;
    } catch(Exception $e){
        $response = $e;
    }
}