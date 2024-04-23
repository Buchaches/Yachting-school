<?php
session_start();

include ("path.php");

unset($_SESSION['user_id']);
unset($_SESSION['email']);
unset($_SESSION['role_id']);

session_destroy();

header('location:' . BASE_URL);