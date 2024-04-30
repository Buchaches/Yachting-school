<?php 
    include "../../../path.php";
    include SITE_ROOT . "/app/database/db.php"; 
?>
<?php

// Редактирование инструктора
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit__btn'])){
    $client_id = $_POST['client_id'];
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

            $post_clients = [
                "user_id "=> $user_id,
                "client_name" => $name,
                "client_surname" => $surname,
                "client_phone" => $phone
            ];
            update("clients","client_id",$client_id,$post_clients);
            $error= '5';
        }
    }
    header("location:" . BASE_URL . "client/settings.php?action=edit&id=".$client_id."&error=".$error);
}

// Удаление клиента
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['drop__btn'])){
    $del = trim($_POST['del']);
    if($del !== 'УДАЛИТЬ'){
        $error= '1';
        header("location:" . BASE_URL . "client/settings.php?action=drop&id=".$client_id."&error=".$error);
    }else{
        $id=$_POST["client_id"];
        $result = selectOne("clients",["client_id"=> $id]);
        $user_id = $result["user_id"];
        deleteOne("clients","client_id",$id);
        deleteOne("users","user_id",$user_id);
        header("location:" . BASE_URL . "logout.php");
    }
}