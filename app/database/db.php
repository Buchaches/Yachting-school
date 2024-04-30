<?php
session_start();

require 'connection.php';

// Вывод
function tte($value){
    echo '<pre>';
    print_r($value);
    echo '</pre>';
    exit();
}
function tt($value){
    echo '<pre>';
    print_r($value);
    echo '</pre>';
}

// Проверка выполнения запроса к БД
function dbCheckError($query){
    $errInfo = $query->errorInfo();
    if ($errInfo[0] !== PDO::ERR_NONE){
        echo $errInfo[2];
        exit();
    }
    return true;
}

// Запрос на получение данных с одной таблицы
function selectAll($table, $params = []){
    global $pdo;
    $sql = "SELECT * FROM $table";

    if(!empty($params)){
        $i = 0;
        foreach ($params as $key => $value){
            if (!is_numeric($value)){
                $value = "'".$value."'";
            }
            if ($i === 0){
                $sql = $sql . " WHERE $key=$value";
            }else{
                $sql = $sql . " AND $key=$value";
            }
            $i++;
        }
    }
    $query = $pdo->prepare($sql);
    $query->execute();
    dbCheckError($query);
    return $query->fetchAll();
}

// Запрос на получение одной строки с выбранной таблицы
function selectOne($table, $params = []){
    global $pdo;
    $sql = "SELECT * FROM $table";

    if(!empty($params)){
        $i = 0;
        foreach ($params as $key => $value){
            if (!is_numeric($value)){
                $value = "'".$value."'";
            }
            if ($i === 0){
                $sql = $sql . " WHERE $key=$value";
            }else{
                $sql = $sql . " AND $key=$value";
            }
            $i++;
        }
    }

    $query = $pdo->prepare($sql);
    $query->execute();
    dbCheckError($query);
    return $query->fetch();
}

// Запись в таблицу БД
function insert($table, $params){
    global $pdo;
    $i = 0;
    $coll = '';
    $mask = '';
    foreach ($params as $key => $value) {
        if ($i === 0){
            $coll = $coll . "$key";
            $mask = $mask . "'" ."$value" . "'";
        }else {
            $coll = $coll . ", $key";
            $mask = $mask . ", '" . "$value" . "'";
        }
        $i++;
    }

    $sql = "INSERT INTO $table ($coll) VALUES ($mask)";

    $query = $pdo->prepare($sql);
    $query->execute();
    dbCheckError($query);
    return $pdo->lastInsertId();
}

// Обновление строки в таблице
function update($table, $name_id, $id, $params){
    global $pdo;
    $i = 0;
    $str = '';
    foreach ($params as $key => $value) {
        if ($i === 0){
            $str = $str . $key . " = '$value'";
        }else {
            $str = $str . ", $key" . " = '$value'";
        }
        $i++;
    }
    $sql = "UPDATE $table SET $str WHERE $name_id = $id";
    $query = $pdo->prepare($sql);
    $query->execute();
    dbCheckError($query);
}

// Удаление строки в таблице
function deleteOne($table, $name_id, $id){
    global $pdo;
    $sql = "DELETE FROM $table WHERE $name_id = $id";
    $query = $pdo->prepare($sql);
    $query->execute();
    dbCheckError($query);
}

// Всего строк в таблице
function countRows($table, $params = []) {
    global $pdo;
    $sql = "SELECT COUNT(*) as total_rows FROM $table";
    if(!empty($params)){
        $i = 0;
        foreach ($params as $key => $value){
            if (!is_numeric($value)){
                $value = "'".$value."'";
            }
            if ($i === 0){
                $sql = $sql . " WHERE $key=$value";
            }else{
                $sql = $sql . " AND $key=$value";
            }
            $i++;
        }
    }
    $query = $pdo->prepare($sql);
    $query->execute();
    dbCheckError($query);
    $result = $query->fetch(PDO::FETCH_ASSOC);
    return $result['total_rows'];
}

// Всего покупок клиентами по ввиду услуги
function countRowsBooking($client_id, $service_id){
    global $pdo;
    $sql = "SELECT COUNT(*) as total_rows
    FROM bookings
    INNER JOIN timeslots ON bookings.slot_id = timeslots.slot_id
    INNER JOIN services ON timeslots.service_id = services.service_id
    WHERE bookings.client_id = '$client_id' AND services.service_id = '$service_id'";
    $query = $pdo->prepare($sql);
    $query->execute();
    dbCheckError($query);
    $result = $query->fetch(PDO::FETCH_ASSOC);
    return $result['total_rows'];
}

// Форматирование даты
function formatData($dateString){
    $dateObj = DateTime::createFromFormat('Y-m-d', $dateString);
    $months = [
        1 => 'Января',
        2 => 'Февраля',
        3 => 'Марта',
        4 => 'Апреля',
        5 => 'Мая',
        6 => 'Июня',
        7 => 'Июля',
        8 => 'Августа',
        9 => 'Сентября',
        10 => 'Октября',
        11 => 'Ноября',
        12 => 'Декабря'
    ];
    $day = ltrim($dateObj->format('d'), '0');
    $monthNum = (int)$dateObj->format('m');
    $month = $months[$monthNum];
    return $day . ' ' . $month;
}

// Форматирование даты в день недели
function formatDataWeek($dateString){
    $days = [
        'Воскресенье', 'Понедельник', 'Вторник', 'Среда', 'Четверг', 'Пятница', 'Суббота'
    ];
    return $days[date("w", strtotime($dateString))];
}

// Форматирование времени
function formatTime($timeString){
    $timeObj = DateTime::createFromFormat('H:i:s', $timeString);
    return $timeObj->format('H:i');
}
