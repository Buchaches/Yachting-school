<?php 
    include "../../../path.php";
    include SITE_ROOT . "/app/database/db.php"; 
?>
<?php

// Редактирование инструктора
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit__btn'])){
    $instructor_id = $_POST['instructor_id'];
    $user_id = $_POST['user_id'];
    $oldemail = $_POST['oldemail'];
    $oldpass = $_POST['oldpass'];
    $name = trim($_POST['name']);
    $surname = trim($_POST['surname']);
    $email = trim($_POST['email']);
    $phone = $_POST['phone'];
    $pass = trim($_POST['pass']);
    $passNew = trim($_POST['passNew']);

    if(empty($name) || empty($surname) || empty($email) || empty($phone) || empty($pass) || empty($passNew)){
        $error='1';
    }elseif(mb_strlen($phone, 'UTF8') < 16){
        $error='2';
    }elseif(!password_verify($pass, $oldpass)){
        $error='3';
    }else{
        $existence = selectOne('users',['email' => $email]);
        if(!empty($existence['email']) && $existence['email'] === $email && $existence['email'] !== $oldemail){
            $error='4';
        }else{
            $pass_hash = password_hash($passNew, PASSWORD_DEFAULT);
            $post_users = [
                "email" => $email,
                "password" => $pass_hash
            ];
            update("users","user_id",$user_id,$post_users);

            $post_instructors = [
                "user_id "=> $user_id,
                "instructor_name" => $name,
                "instructor_surname" => $surname,
                "instructor_phone" => $phone
            ];
            update("instructors","instructor_id",$instructor_id,$post_instructors);
            $error= '5';
        }
    }
    header("location:" . BASE_URL . "instructor/settings.php?action=edit&id=".$instructor_id."&error=".$error);
}
