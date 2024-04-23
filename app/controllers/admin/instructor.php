<?php 
    include "../../../path.php";
    include SITE_ROOT . "/app/database/db.php"; 
?>
<?php

// Создание инструктора
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add__btn'])){

    $name = trim($_POST["name"]);
    $surname = trim($_POST["surname"]);
    $email = trim($_POST["email"]);
    $phone = $_POST["phone"];
    $status = trim($_POST["status"]);
    $certification = trim($_POST["certification"]);
    $pass = trim($_POST["pass"]);
    $role = 2;

    if(empty($name) || empty($surname) || empty($email) || empty($phone) || empty($status) || empty($certification) ||empty($pass)){
        $error='1';
    }elseif(mb_strlen($phone, 'UTF8') < 16){
        $error='2';
    }else{
        $existence = selectOne('users',['email' => $email]);
        if(!empty($existence['email']) && $existence['email'] === $email){
            $error='3';
        }else{
            $pass_hash = password_hash($pass, PASSWORD_DEFAULT);
            $post_users = [
                "email" => $email,
                "password" => $pass_hash,
                "role_id" => $role
            ];
            $user_id = insert("users",$post_users);

            $post_instructors = [
                "user_id "=> $user_id,
                "instructor_name" => $name,
                "instructor_surname" => $surname,
                "instructor_phone" => $phone,
                "status"=> $status,
                "certification"=> $certification
            ];
            $instructor_id = insert("instructors",$post_instructors);
            $error= '4';
        }
    }
    header("location:" . BASE_URL . "admin/instructors.php?action=add&id=none&error=".$error);
}
// Редактирование инструктора
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit__btn'])){
    $instructor_id = $_POST["instructor_id"];
    $user_id = $_POST["user_id"];
    $oldemail = $_POST["oldemail"];
    $name = trim($_POST["name"]);
    $surname = trim($_POST["surname"]);
    $email = trim($_POST["email"]);
    $phone = $_POST["phone"];
    $status = trim($_POST["status"]);
    $certification = trim($_POST["certification"]);
    $pass = trim($_POST["pass"]);

    if(empty($name) || empty($surname) || empty($email) || empty($phone) || empty($status) || empty($certification) ||empty($pass)){
        $error='1';
    }elseif(mb_strlen($phone, 'UTF8') < 16){
        $error='2';
    }else{
        $existence = selectOne('users',['email' => $email]);
        if(!empty($existence['email']) && $existence['email'] === $email && $existence['email'] !== $oldemail){
            $error='3';
        }else{
            $pass_hash = password_hash($pass, PASSWORD_DEFAULT);
            $post_users = [
                "email" => $email,
                "password" => $pass_hash
            ];
            update("users","user_id",$user_id,$post_users);

            $post_instructors = [
                "instructor_name" => $name,
                "instructor_surname" => $surname,
                "instructor_phone" => $phone,
                "status"=> $status,
                "certification"=> $certification
            ];
            update("instructors","instructor_id",$instructor_id,$post_instructors);
            $error= '4';
        }
    }
    header("location:" . BASE_URL . "admin/instructors.php?action=edit&id=".$instructor_id."&error=".$error);
}

// Удаление инструктора
if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['action']) && $_GET['action'] === 'drop'){
    $id=$_GET["id"];
    $result = selectOne("instructors",["instructor_id"=> $id]);
    $user_id = $result["user_id"];
    deleteOne("instructors","instructor_id",$id);
    deleteOne("users","user_id",$user_id);
    header("location:" . BASE_URL . "admin/instructors.php");
}
