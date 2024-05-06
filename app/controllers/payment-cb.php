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
        
    }
} catch (Exception $e) {
    $response = $e;
}