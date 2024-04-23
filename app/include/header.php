<header class="header__default">
    <div class="header__container">
        <a href="<?php echo BASE_URL ?>" class="logo">
            <strong>Yar</strong>Yachts 
            <svg version="1.0" xmlns="http://www.w3.org/2000/svg" width="41" height="33" viewBox="0 0 1280.000000 1033.000000" preserveAspectRatio="xMidYMid meet">
                <g transform="translate(0.000000,1033.000000) scale(0.100000,-0.100000)"fill="#4e88b8" stroke="none">
                <path d="M3290 10320 c-1 -20 72 -811 120 -1300 33 -338 101 -1041 125 -1305
                126 -1388 152 -2582 79 -3610 -34 -490 -105 -1074 -178 -1483 l-23 -132 339 0
                c850 0 1543 -95 2398 -330 282 -78 564 -167 1259 -401 360 -121 658 -218 661
                -217 14 6 -541 1419 -823 2098 -1138 2739 -2194 4593 -3528 6195 -177 213
                -428 496 -429 485z" />
                <path d="M2901 8508 c-29 -106 -82 -296 -116 -423 -35 -126 -96 -347 -135
                -490 -100 -365 -200 -727 -281 -1022 -38 -139 -100 -367 -138 -505 -38 -139
                -102 -370 -141 -513 -39 -143 -103 -374 -141 -512 -38 -139 -101 -369 -140
                -510 -39 -142 -102 -372 -140 -510 -38 -139 -100 -367 -138 -505 -38 -139
                -102 -370 -141 -513 -39 -143 -92 -333 -117 -423 -25 -90 -43 -165 -41 -168 3
                -2 47 16 99 40 413 195 888 227 1467 99 63 -14 115 -23 117 -21 1 1 8 800 14
                1773 7 974 16 2359 21 3079 5 721 8 1311 6 1313 -1 2 -26 -84 -55 -189z"/>
                <path d="M2195 2213 c-396 -31 -605 -63 -925 -143 -406 -101 -844 -278 -1167
                -469 l-102 -61 205 -313 c114 -171 207 -313 209 -315 1 -2 57 32 122 76 483
                315 1087 521 1769 602 229 28 796 38 1086 21 516 -32 1068 -109 1733 -245 370
                -75 733 -159 1610 -370 1017 -245 1366 -320 1855 -400 755 -124 1647 -167
                2795 -136 566 15 1329 41 1340 45 6 2 -35 4 -90 4 -156 1 -1139 29 -1435 41
                -1255 49 -2071 155 -2968 385 -344 89 -722 198 -1467 427 -846 258 -1434 427
                -1870 533 -734 181 -1318 277 -1900 315 -143 9 -699 12 -800 3z" />
                <path d="M2400 1256 c-546 -54 -1022 -199 -1412 -431 l-78 -45 150 -225 149
                -224 103 65 c57 36 166 96 243 134 706 346 1576 399 2795 170 371 -70 613
                -124 1370 -306 1089 -263 1442 -326 2069 -369 316 -22 900 -29 1331 -16 206 6
                483 14 615 18 309 9 244 18 -185 27 -1293 25 -2007 102 -2760 297 -222 58
                -523 145 -930 269 -1428 436 -1947 559 -2660 630 -173 18 -647 21 -800 6z"/>
                </g>
            </svg>
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
                        <lord-icon id="menuButton" onclick="toggleMenu()" src="https://cdn.lordicon.com/kthelypq.json" trigger="click" colors="primary:#ffffff" style="width:32px;height:32px"></lord-icon>
                    </button>
                    <ul class="header__account__menu" id="dropdownMenu">
                        <?php if ($_SESSION['role_id'] === '3'): ?>
                            <li class="header__account__menu-items">
                                <a class="header__account__menu-item" href="<?php echo BASE_URL . 'client/client.php'?>" class="">Личный кабинет</a>
                            </li>
                        <?php elseif ($_SESSION['role_id'] === '2'): ?>
                            <li class="__account__menu-items">
                                <a class="header__account__menu-item" href="<?php echo BASE_URL . 'instructor/instructor.php'?>" class="">Инструкторская</a>
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