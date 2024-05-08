<?php

use YooKassa\Model\Notification\NotificationSucceeded;
use YooKassa\Model\Notification\NotificationWaitingForCapture;
use YooKassa\Model\Notification\NotificationEventType;

include "../../path.php";
include SITE_ROOT . "/app/database/db.php"; 
require SITE_ROOT . '/vendor/autoload.php';

$source = file_get_contents('php://input');
$requestBody = json_decode($source, true);

try {
    $notification = ($requestBody['event'] === NotificationEventType::PAYMENT_SUCCEEDED)
    ? new NotificationSucceeded($requestBody)
    : new NotificationWaitingForCapture($requestBody);

    $payment_status = $requestBody['object']['status'] ?? '';
    $payment_id = $requestBody['object']['id'] ?? '';
    $payment_paid = $requestBody['object']['paid'] ?? '';
    $payment_paid = $requestBody['object']['test'] ?? '';
    $payment_amount = $requestBody['object']['amount']['value'] ?? '';
    $payment_order_id = $requestBody['object']['metadata']['orderNumber'] ?? '';
    $payment_capacity =  $requestBody['object']['metadata']['capacity'];
    $payment_instructor =  $requestBody['object']['metadata']['instructor'];
    $payment_client =  $requestBody['object']['metadata']['client'];
    $payment_slot =  $requestBody['object']['metadata']['slot'];
    

    $instructor = selectOne("instructor_timeslots",['slot_id' => $payment_slot, 'instructor_id' => $payment_instructor]);
    $id = $instructor['id'];
    $remaining_capacity_instructor = $instructor['remaining_capacity'];
    $remaining_capacity_instructor -= (int)$payment_capacity;

    if($payment_status == 'succeeded' && $payment_paid){
        //Изменение статуса
        $post_booking = [
            "status" => 1
        ];
        update("bookings", "booking_id", $payment_order_id, $post_booking);
        //Изменение количества свободных мест на слоте
        $slot = selectOne("timeslots",['slot_id' => $payment_slot]);
        $remaining_capacity = $slot['remaining_capacity'];
        $remaining_capacity -= (int)$payment_capacity;

        $post_slots = [
            "remaining_capacity" => $remaining_capacity
        ];
        update("timeslots", "slot_id", $payment_slot, $post_slots);
        //Изменение количества свободных мест у конкретного инструктора на слоте
        if($payment_instructor != null){

            $instructor = selectOne("instructor_timeslots",['slot_id' => $payment_slot, 'instructor_id' => $payment_instructor]);
            $id = $instructor['id'];
            $remaining_capacity_instructor = $instructor['remaining_capacity'];
            $remaining_capacity_instructor -= (int)$payment_capacity;

            $post_instructors = [
                "remaining_capacity" => $remaining_capacity_instructor
            ];
            update("instructor_timeslots", "id", $id, $post_instructors);
        }
        //Отправка письма
        if($payment_client != null){
            $slot = selectOne("timeslots",['slot_id' => $payment_slot]);
            $timeAdd = DateTime::createFromFormat('H:i:s', $slot['time_finish']);
            $timeAdd->modify('+3 minutes');
            $time_finish = $timeAdd->format('H:i:s');
            $time_finish = formatTime($time_finish);
            $time_start = formatTime($slot['time_start']);
            $date = formatData($slot['date']);
            $services = selectOne("services",['service_id' => $slot['service_id']]);
            $client = selectOne("clients",['client_id' => $payment_client]);
            $user_id = $client['user_id'];
            $clientUser = selectOne("users",['user_id' => $user_id]);

            $to = $clientUser['email'];
            $subject = '=?utf-8?B?' . base64_encode('Подтверждение бронирования') . '?=';
            $message = 'Уважаемый ' . $client['client_name'] . ',' . "\n\n" . 'Мы рады сообщить вам, что ваше бронирование в нашей яхт-школе было успешно подтверждено.' . "\n\n" . 'Ниже приведены детали вашего бронирования:' . "\n\n" . '• Услуга: ' . $services['name'] . "\n" . '• Дата: ' . $date . "\n" . '• Время начала: ' . $time_start . "\n" . '• Время окончания: ' . $time_finish . "\n" . '• Количество мест: ' . $payment_capacity . "\n" . '• Стоимость: ' . $payment_amount . " RUB\n\n" . 'Мы высоко ценим ваше доверие к нашим услугам и с нетерпением ждем возможности предоставить вам незабываемый опыт в мире яхтинга!' . "\n\n" . 'C уважением,' . "\n" . 'YarYachts.ru';
        
            $headers = [
                "From" => "support@yaryachts.ru",
                "Reply-To" => "support@yaryachts.ru",
                "Content-Type" => "text/plain; charset=utf-8",
            ];
        
            mail($to, $subject, $message, $headers);
        }
    }
} catch (Exception $e) {
    $response = $e;
}