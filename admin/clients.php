<?php 
    include "./../path.php";
    include "./../app/database/db.php";
?>
<?php 
    if(isset($_SESSION['email'])){
        if($_SESSION["email"] == "" or $_SESSION['role_id']!='1'){
            header('location:' . BASE_URL. 'login.php');
        }
    }else{
        header('location:' . BASE_URL . 'login.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#fafafa" media="(prefers-color-scheme: light)">
    <meta name="theme-color" content="#fafafa" media="(prefers-color-scheme: dark)">
    <title>Админ панель - Клиенты</title>
    
    <!-- -------------   CSS   ------------- -->
    <link rel="stylesheet" href="../assets/css/dashboard.css">
    <link rel="stylesheet" href="../assets/css/dashmedia.css">
    <!-- -----------   END CSS   ----------- -->
    
    <!-- -------------   Favicon   ------------- -->
    <link rel="apple-touch-icon" sizes="180x180" href="../assets/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../assets/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/favicons/favicon-16x16.png">
    <link rel="manifest" href="../assets/favicons/site.webmanifest">
    <link rel="mask-icon" href="../assets/favicons/safari-pinned-tab.svg" color="#3a3a3a">
    <meta name="msapplication-TileColor" content="#3a3a3a">
    <meta name="theme-color" content="#3a3a3a">
    <!-- -----------   END Favicon   ----------- -->
    
</head>
<body>
    <div class="dashboard">
        <?php include("../app/include/admin_sidebar.php"); ?>
        <div class="body">
            <header class="header">
                <button id="sidebar-btn" class="sidebar-btn">
                    <img id="sidebar-btn-img" src="./../assets/img/icon/sidebar_menu/sidebar-open.svg" alt="Nav button">
                </button>   
                <h1 class="header__title">Клиенты</h1>
                <form action="" method="post" class="header__search">
                    <input type="search" id="search" name="search" class="header__searchbar" placeholder="Введите имя или email клиента">
                    <?php
                        echo '<datalist id="people">';
                        $clients = selectAll("clients");
                        $users = selectAll("users", ["role_id" => '3']);
                        foreach ($clients as $client) {
                            $surname = $client["client_surname"];
                            $name = $client["client_name"];
                            $fullName = $surname . ' ' . $name;
                            echo "<option value='$fullName'>";  
                         }
                        foreach ($users as $user) {
                            $email = $user["email"];
                            echo "<option value='$email'><br/>";
                        }
                        echo ' </datalist>';                       
                    ?>
                    <button type="Submit" name="search__btn" value="Search" class="primary__btn search__btn">Поиск</button>
                </form>
                <div class="header__calendar">
                    <div class="calendar__text">
                        <p class="calendar__title">Today's Date</p>
                        <p class="calendar__date">
                            <?php
                                date_default_timezone_set('Europe/Moscow');
                                $date = date('Y-m-d');
                                echo $date;
                            ?>
                        </p>
                    </div>
                    <div class="calendar__img">
                        <lord-icon src="https://cdn.lordicon.com/abfverha.json" trigger="hover" colors="primary:#1a1a1a" style="width:40px;height:40px"></lord-icon>
                    </div>
                </div>
            </header>

            <main class="main">
                <div class="main__container">
                    <div class="row__counter">Всего клиентов&nbsp;(<?=$totalClients = countRows("clients")?>)</div>
                    <div class="table__container">
                        <table class="main__table">
                            <thead>
                                <tr>
                                    <th>Фамилия</th>
                                    <th>Имя</th>
                                    <th>Номер телефона</th>
                                    <th>Email</th>
                                    <th><p class="th__data__text">Дата регистрации <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M480-345 240-585l56-56 184 184 184-184 56 56-240 240Z"/></svg></p></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['search__btn'])){
                                        $keyword=trim($_POST["search"]);
                                        $sql = "SELECT clients.client_id, clients.client_surname, clients.client_name, clients.client_phone, users.email, users.created
                                        FROM clients
                                        INNER JOIN users ON clients.user_id = users.user_id 
                                        WHERE users.email = '$keyword' OR users.email LIKE '$keyword%' OR users.email LIKE '%$keyword' OR users.email LIKE '%$keyword%'
                                        OR clients.client_surname = '$keyword' OR clients.client_surname LIKE '$keyword%' OR clients.client_surname LIKE '%$keyword' OR clients.client_surname LIKE '%$keyword%'
                                        OR clients.client_name = '$keyword' OR clients.client_name LIKE '$keyword%' OR clients.client_name LIKE '%$keyword' OR clients.client_name LIKE '%$keyword%'
                                        OR CONCAT(clients.client_surname, ' ', clients.client_name) = '$keyword' OR CONCAT(clients.client_name, ' ', clients.client_surname) = '$keyword'";
                                    }else{
                                        $sql = "SELECT clients.client_id, clients.client_surname, clients.client_name, clients.client_phone, users.email, users.created
                                        FROM clients
                                        INNER JOIN users ON clients.user_id = users.user_id
                                        ORDER BY users.created DESC";
                                    }   
                                    $query = $pdo->prepare($sql);
                                    $query->execute();
                                    dbCheckError($query);
                                    $rowCount = $query->rowCount();
                                    if($rowCount > 0){
                                        while ($row = $query->fetch()) {
                                            echo "<tr>
                                            <td>".$row["client_surname"]."</td>
                                            <td>".$row["client_name"]."</td>
                                            <td style = 'white-space: nowrap'>".$row["client_phone"]."</td>
                                            <td>".$row["email"]."</td>
                                            <td>".$row["created"]."</td>
                                            </tr>";
                                        }    
                                    } else { 
                                        echo '<tr>
                                        <td colspan="5">
                                        <img src="../assets/img/icon/not_found.svg" width="360px">
                                        <p>К сожалению, по вашему запросу ничего не найдено</p>
                                        <br><br>
                                        </td>
                                        </tr>'; 
                                    }
                                ?>           
                            </tbody>
                        </table>
                    </div>
                </div>    
            </main>
        </div>
    </div>
<!-- ---------------   JS   --------------- -->
<script src="../assets/js/libraries/lordicon.js"></script>
<script src="../assets/js/sidebar.js"></script>
<script src="../assets/js/admin/clients.js"></script>
<!-- -------------   END js   ------------- -->

</body>
</html>