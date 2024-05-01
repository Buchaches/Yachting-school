<?php
include "./app/database/db.php";

$errMsg = "";

// Форма регистрации
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['reg__btn'])){

    $name = trim($_POST["name"]);
    $surname = trim($_POST["surname"]);
    $email = trim($_POST["email"]);
    $phone = $_POST["phone"];
    $pass = trim($_POST["pass"]);
    $role = 3;

    if(empty($name) || empty($surname) || empty($email) || empty($phone) || empty($pass)){
        $errMsg = "Не все поля заполнены!";
    }elseif(mb_strlen($phone, 'UTF8') < 16){
        $errMsg = 'Введите свой номер телефона полностью!';
    }else{
        $existence = selectOne('users',['email' => $email]);
        if(!empty($existence['email']) && $existence['email'] === $email){
            $errMsg = 'Пользователь с такой почтой уже уже существует!';
        }else{
            $pass_hash = password_hash($pass, PASSWORD_DEFAULT);
            $post_users = [
                "email" => $email,
                "password" => $pass_hash,
                "role_id" => $role
            ];
            $user_id = insert("users",$post_users);

            $post_clients = [
                "user_id "=> $user_id,
                "client_name" => $name,
                "client_surname" => $surname,
                "client_phone" => $phone
            ];
            $client_id = insert("clients",$post_clients);
            
            header('location:' . BASE_URL . 'login.php');
        }
    }
}else{
    $name = '';
    $surname = '';
    $email = '';
    $phone = '';
}

// Форма авторизации
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login__btn'])){
    $email = trim($_POST["email"]);
    $pass = trim($_POST["pass"]);

    if(empty($email) || empty($pass)){
        $errMsg = "Не все поля заполнены!";
    }else{
        $existence = selectOne('users',['email' => $email]);
        if($existence && password_verify($pass, $existence['password'])){
            $_SESSION['user_id'] =  $existence['user_id'];
            $_SESSION['email'] = $existence['email'];
            $_SESSION['role_id'] =  $existence['role_id'];
            if ($_SESSION['role_id'] == '3'){
                $existence = selectOne('clients',['user_id'=> $_SESSION['user_id']]);
                $_SESSION['name'] = $existence['client_name'];
                $_SESSION['client_id'] = $existence['client_id'];
            }elseif ($_SESSION['role_id'] == '2'){
                $existence = selectOne('instructors',['user_id'=> $_SESSION['user_id']]);
                $_SESSION['name'] =  $existence['instructor_name'];
                $_SESSION['instructor_id'] = $existence['instructor_id'];
            }

            header('location:' . BASE_URL);
        }else{
            $errMsg = "Ой! У нас нет такого сочетания почты и пароля";
        }
    }
}else{
    $email = '';
}