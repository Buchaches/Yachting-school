<header class="header__default">
    <div class="header__container">
        <a href="<?php echo BASE_URL ?>" class="logo">
            <strong>Yar</strong>Yachts 
            <img src="./assets/img/icon/yachts.svg" alt="logo">
        </a>
        <nav id="nav" class="header__nav">
            <ul class="header__list">
                <li class="header__list-item">
                    <a href="<?php echo BASE_URL . '#welcome' ?>" class="nav__link">Главная</a>
                </li>
                <li class="header__list-item">
                    <a href="<?php echo BASE_URL .'#services'?>" class="nav__link">Программы</a>
                </li>
                <li class="header__list-item">
                    <a href="<?php echo BASE_URL .'#yacht'?>" class="nav__link">Яхта</a>
                </li>
                <li class="header__list-item">
                    <a href="<?php echo BASE_URL .'#instructors'?>" class="nav__link">Инструкторы</a>
                </li>
                <li class="header__list-item">
                    <a href="<?php echo BASE_URL .'#windy'?>" class="nav__link">Погода</a>
                </li>
                <li class="header__list-item">
                    <a href="<?php echo BASE_URL .'#contact'?>" class="nav__link">Контакты</a>
                </li>
            </ul>
        </nav>
        <div class="header__actions">
            <?php if (isset($_SESSION['user_id'])):?>
                <div class="header__account">
                    <button class= "header__account__btn">
                        <lord-icon id="menuButton" onclick="toggleMenu()" src="https://cdn.lordicon.com/kthelypq.json" trigger="click" colors="primary:#ffffff" style="width:32px;height:32px;cursor:pointer"></lord-icon>
                    </button>
                    <ul class="header__account__menu" id="dropdownMenu">
                        <?php if ($_SESSION['role_id'] === '3'): ?>
                            <li class="header__account__menu-items">
                                <a class="header__account__menu-item" href="<?php echo BASE_URL . 'client/index.php'?>" class="">Личный кабинет</a>
                            </li>
                        <?php elseif ($_SESSION['role_id'] === '2'): ?>
                            <li class="__account__menu-items">
                                <a class="header__account__menu-item" href="<?php echo BASE_URL . 'instructor/index.php'?>" class="">Инструкторская</a>
                            </li>
                        <?php elseif ($_SESSION['role_id'] === '1'): ?>
                            <li class="__account__menu-items">
                                <a class="header__account__menu-item" href="<?php echo BASE_URL . 'admin/index.php'?>" class="">Админ панель</a>
                            </li>
                        <?php endif; ?>
                        <li class="header__account__menu-items">
                            <a class="header__account__menu-item" href="#!!!" class="">Выйти</a>
                        </li>
                    </ul>
                </div>
            <?php else:?>
                <div class="header__account">
                    <a href="<?php echo BASE_URL . 'login.php'?>" class="header__account__login">
                        <lord-icon src="https://cdn.lordicon.com/kthelypq.json" trigger="hover" colors="primary:#ffffff" style="width:32px;height:32px"></lord-icon>
                    </a>
                </div>
            <?php endif;?>
            <button id="nav-btn" class="nav-btn">
                <img id="nav-btn-img" src="./assets/img/icon/header_menu/nav-open.svg" alt="Nav button">
            </button>
        </div>
    </div>
</header>