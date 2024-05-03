<?php 
    include "../../../path.php";
    include SITE_ROOT . "/app/database/db.php"; 
?>
<?php 

// Создание слота
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add__btn'])){
    $max_capacity = 24; // Всего возможных мест ,учитывая флот, состоящий из 6 яхт.
    $max_people = 4; // Всего мест у 1 инструктора
    $service_name = $_POST["service"];
    $date = $_POST["date"];
    $time_start = $_POST["time_start"];
    $yachts_number = $_POST["number"];
    $instructors = $_POST["instructors"];
    $capacity = $max_people * $yachts_number;
    
    $service = "SELECT service_id, duration FROM services WHERE name = '$service_name'";
    $stmt = $pdo->prepare($service);
    $stmt->execute();
    $result= $stmt->fetch();
    $service_id = $result['service_id'];
    $duration = $result['duration'];

    $start = DateTime::createFromFormat('H:i', $time_start);
    $hours = floor($duration);
    $minutes = round(($duration - $hours) * 60);
    $end = clone $start;
    $end->add(new DateInterval('PT' . $hours . 'H' . $minutes . 'M'));
    $time_finish = $end->format('H:i:s');
    $time_start = $start->format('H:i:s');

    $instructors_number = count($instructors);

    if(empty($service_name) || empty($date) || empty($time_start) || empty($yachts_number) || empty($instructors) || empty($capacity)){
        $error='1';
    }elseif($instructors_number < $yachts_number){
        $error='2';
    }else{
        $sum = "SELECT SUM(total_capacity) FROM timeslots WHERE date = '$date' AND time_start BETWEEN '$time_start' AND '$time_finish' OR time_finish BETWEEN '$time_start' AND '$time_finish';";
        $stmt = $pdo->prepare($sum);
        $stmt->execute();
        $result = $stmt->fetch();
        $sum_capacity = $result['SUM(total_capacity)'];

        if(($sum_capacity != null) && ($sum_capacity + $capacity > $max_capacity)){
            $error='3';
        }else{
            $post_timeslots = [
                "service_id" => $service_id,
                "date" => $date,
                "time_start" => $time_start,
                "time_finish" => $time_finish,
                "total_capacity" => $capacity,
                "remaining_capacity" => $capacity
            ];
            $slot_id = insert("timeslots",$post_timeslots);

            foreach($instructors as $key => $instructor) {
                $post_instructors = [
                    "instructor_id" => $instructor,
                    "slot_id" => $slot_id,
                    "total_capacity" => $max_people,
                    "remaining_capacity" => $max_people
                ];
                $instructor_id = insert("instructor_timeslots",$post_instructors);
            }
            $error= '4';
        }   
    }
    header("location:" . BASE_URL . "admin/timeslots.php?action=add&id=none&error=".$error);    
}

// Редактирование слота
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit__btn'])){
    $max_capacity = 24; // Всего возможных мест ,учитывая флот, состоящий из 6 яхт.
    $max_people = 4; // Всего мест у 1 инструктора
    $slot_id = $_POST["slot_id"];
    $service_name = $_POST["service"];
    $date = $_POST["date"];
    $time_start = $_POST["time_start"];
    $yachts_number = $_POST["number"];
    $old_number = $_POST["old_number"];
    $old_capacity = $max_people * $old_number;
    $capacity = $max_people * $yachts_number;
    if(!empty($_POST["instructors"])){
        $instructors = $_POST["instructors"];
    }
    
    $service = "SELECT service_id, duration FROM services WHERE name = '$service_name'";
    $stmt = $pdo->prepare($service);
    $stmt->execute();
    $result= $stmt->fetch();
    $service_id = $result['service_id'];
    $duration = $result['duration'];

    $start = DateTime::createFromFormat('H:i', $time_start);
    $hours = floor($duration);
    $minutes = round(($duration - $hours) * 60);
    $end = clone $start;
    $end->add(new DateInterval('PT' . $hours . 'H' . $minutes . 'M'));
    $time_finish = $end->format('H:i:s');
    $time_start = $start->format('H:i:s');

    if(empty($service_name) || empty($date) || empty($time_start) || empty($yachts_number) || empty($capacity)){
        $error='1';
    }else{
        $sum = "SELECT SUM(total_capacity) FROM timeslots WHERE date = '$date' AND time_finish BETWEEN '$time_start' AND '$time_finish'";
        $stmt = $pdo->prepare($sum);
        $stmt->execute();
        $result = $stmt->fetch();
        $sum_capacity = $result['SUM(total_capacity)'];

        if(($sum_capacity != null) && ($sum_capacity + $capacity - $old_capacity > $max_capacity)){
            $error='3';
        }else{
            $post_timeslots = [
                "service_id" => $service_id,
                "date" => $date,
                "time_start" => $time_start,
                "time_finish" => $time_finish,
                "total_capacity" => $capacity,
                "remaining_capacity" => $capacity
            ];

            update("timeslots","slot_id",$slot_id,$post_timeslots);

            if(isset($instructors)){
                foreach($instructors as $key => $instructor) {
                    $post_instructors = [
                        "instructor_id" => $instructor,
                        "slot_id" => $slot_id,
                        "total_capacity" => $max_people,
                        "remaining_capacity" => $max_people
                    ];
                    $instructor_id = insert("instructor_timeslots",$post_instructors);
                }
            }
            $error= '4';
        }
    }
    header("location:" . BASE_URL . "admin/timeslots.php?action=edit&id=".$slot_id."&error=".$error);
}

// Удаление слота
if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['action']) && $_GET['action'] === 'drop'){
    $id=$_GET["id"];
    $results = selectAll("instructor_timeslots",["slot_id"=> $id]);
    foreach($results as $key => $result){
        deleteOne("instructor_timeslots","slot_id",$id);
    }
    deleteOne("timeslots","slot_id",$id);

    header("location:" . BASE_URL . "admin/timeslots.php");
}

// Удаление инструктора на слоте
if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['action']) && $_GET['action'] === 'instructor-drop'){
    $id=$_GET["id"];
    $slot_id=$_GET["slot"];
    deleteOne("instructor_timeslots","id",$id);

    header("location:" . BASE_URL . "admin/timeslots.php");
}
