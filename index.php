<?php 
    include "path.php"; 
    include "./app/database/db.php"; 
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>YarYachts - Школа Яхтинга</title>
    
    <!-- -------------   CSS   ------------- -->
    <link rel="stylesheet" href="./assets/css/main.css">
    <link rel="stylesheet" href="./assets/css/media.css">
    <!-- -----------   END CSS   ----------- -->

    <!-- -------------   Favicon   ------------- -->
    <link rel="apple-touch-icon" sizes="180x180" href="./assets/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="./assets/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="./assets/favicons/favicon-16x16.png">
    <link rel="manifest" href="./assets/favicons/site.webmanifest">
    <link rel="mask-icon" href="./assets/favicons/safari-pinned-tab.svg" color="#3a3a3a">
    <meta name="msapplication-TileColor" content="#3a3a3a">
    <meta name="theme-color" content="#3a3a3a">
    <!-- -----------   END Favicon   ----------- -->

</head>

<body>

    <header class="header">
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
                        <a href="#welcome" class="nav__link">Главная</a>
                    </li>
                    <li class="header__list-item">
                        <a href="#services" class="nav__link">Программы</a>
                    </li>
                    <li class="header__list-item">
                        <a href="#yacht" class="nav__link">Яхта</a>
                    </li>
                    <li class="header__list-item">
                        <a href="#instructors" class="nav__link">Инструкторы</a>
                    </li>
                    <li class="header__list-item">
                        <a href="#windy" class="nav__link">Погода</a>
                    </li>
                    <li class="header__list-item">
                        <a href="#contact" class="nav__link">Контакты</a>
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
                                <a class="header__account__menu-item" href="<?php echo BASE_URL . 'logout.php'?>" class="">Выйти</a>
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

    <main class="main">

        <section class="welcome" id="welcome">
            <div class="welcome__container">
                <div class="welcome__text element-animation">
                    <h1 class="welcome__title">Яхтинг в Ярославле</h1>
                    <p class="welcome__desc">Команда опытных инструкторов гарантирует вам уникальный взгляд на мир
                        яхтинга, независимо от ваших предпочтений.</p>
                    <a href="#" class="booking__btn">Забронировать</a>
                </div>
            </div>
        </section>

        <section class="services" id="services">
            <div class="services__container">
                <div class="services__card element-animation">
                    <img src="./assets/img/service/training.png" alt="Тренировки" class="services__img">
                    <h3 class="services__title">Тренировки</h3>
                    <p class="services__desk">Для тех, кто хочет стать лучшим в парусном спорте</p>
                </div>
                <div class="services__card element-animation">
                    <img src="./assets/img/service/trip.jpg" alt="Прогулки" class="services__img">
                    <h3 class="services__title">Прогулки</h3>
                    <p class="services__desk">Лучшие закаты, лучшие виды, безграничный чил</p>
                </div>
                <div class="services__card element-animation">
                    <img src="./assets/img/service/race.jpg" alt="Гонки" class="services__img">
                    <h3 class="services__title">Гонки</h3>
                    <p class="services__desk">Каждую субботу и иногда по воскресеньям</p>
                </div>
            </div>
        </section>

        <section class="yacht" id="yacht">
            <div class="yacht__container">
                <div class="yacht__wrapper">
                    <div class="yacht__text">
                        <div class="yacht__title">На чем тренируемся</div>
                        <h3 class="yacht__text__title">
                            Практические занятия проходят на парусных яхтах международного
                            класса J70.
                        </h3>
                        <p class="yacht__text__desc">
                            Парусная яхта J/70 отличается хорошими гоночными характеристиками: скоростью,
                            маневренностью, стабильностью на воде, легкостью в управлении. Яхта отлично показывает себя
                            как при легких ветрах, так и в сложных погодных условиях — при большой волне и сильном
                            ветре.
                        </p>
                        <p class="yacht__text__desc">
                            J/70 — это килевая яхта. Тяжелый чугунный киль, расположенный на дне лодки, придает ей
                            устойчивость. Такие яхты не переворачиваются и подходят не только опытным яхтсменам, но и
                            абсолютным новичкам.
                        </p>
                        <div class="yacht__dimension__card">
                            <h4>J70</h4>
                            <div class="yacht__dimension__list">
                                <ul class="dimension__list">
                                    <li>Длина — 6,93 м</li>
                                    <li>Ширина — 2,25 м</li>
                                    <li>Осадка — 1,45 м</li>
                                    <li>Водоизмещение — 793 кг</li>
                                    <li>Вес киля — 300 кг</li>
                                </ul>
                                <ul class="dimension__list">
                                    <li>Площадь парусности:</li>
                                    <li>Лавировочная — 26.38 м²</li>
                                    <li>Полные курсы — 61.68 м²</li>
                                    <li>Геннакер — 45 м²</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <img src="./assets/img/yacht.png" alt="Схема" class="yacht__img element-animation">
                </div>
            </div>
        </section>

        <section class="instructors" id="instructors">
            <div class="instructors__container">
                <div class="instructors__title">Инструкторы</div>
                <div class="instructors__slider">
                    <div class="swiper instructors-slider">
                        <div class="swiper-wrapper">

                            <div class="swiper-slide instructors-slide"
                                onclick="openPopup('./assets/img/instructors/1.jpg', 'Мущинин Иван', 'Скорость, свобода, отдых — вот что чувствует Ваня, рассекая волжские волны. В семь лет он начал заниматься парусным спортом. С того момента произошло много всего, но кое-что осталось неизменным — его любовь к парусам, ветру и воде. Большую часть времени в парусном спорте он гонялся на «Луче», но мечтает погонять на «Лазере». Страсть к воде ему привил дед, когда катал его в детстве по Волге. <br><br> Ване нравятся неизведанные места. Именно с помощью парусов вы можете оказаться там, куда не добраться никаким другим способом. Он предпочитает природу городской суете, поэтому не любит квартиры и выбирает дом. Путешествия дают Ване энергию и новые образы: последний раз он исследовал старую дорогу до Красной Поляны. Ваня отлично ориентируется на местности и знает каждый метр нашей акватории. Кроме того он любит рыбачить и подскажет, где хорошо клюёт. А если сломалась машина — поделитесь проблемой с Ваней, он отлично разбирается в ремонте автомобилей.')">
                                <div class="instructors__thumb">
                                    <img class="instructors__img" src="./assets/img/instructors/1.jpg" alt="">
                                    <div class="instructors-slide__text">
                                        <div class="instructors-slide__name">Мущинин Иван</div>
                                    </div>
                                </div>
                            </div>

                            <div class="swiper-slide instructors-slide"
                                onclick="openPopup('./assets/img/instructors/2.jpg', 'Бучин Глеб', 'Наш инструктор Глеб — воспитанник ярославского парусного клуба, студент и просто хороший парень. Он с детства занимается парусным спортом, но все ещё находит в этом деле много нового и интересного. Глеб считает, что ему повезло: в Силе ветра у него появилась возможность передавать опыт и любовь к яхтингу и знакомиться с интересными людьми. Ну и, конечно, наслаждаться видами нашего красивого города с воды. <br><br> На тренировках с Глебом можно услышать интересные истории. Например, как это — попасть в шторм на Рыбинском море или каково встречать рассвет на яхте. Глеб увлекается не только яхтингом, ещё он активно изучает программирование и интересуется плёночной фотографией.<br><br>Если хотите тренироваться так, чтобы знать все нюансы настройки парусов и услышать супер истории из многочисленных походов, вам к Глебу')">
                                <div class="instructors__thumb">
                                    <img class="instructors__img" src="./assets/img/instructors/2.jpg" alt="">
                                    <div class="instructors-slide__text">
                                        <div class="instructors-slide__name">Бучин Глеб</div>
                                    </div>
                                </div>
                            </div>

                            <div class="swiper-slide instructors-slide"
                                onclick="openPopup('./assets/img/instructors/3.jpg', 'Харченко Андрей', 'Основное дело Андрея — барное. Наверняка вы встречали его за стойкой или пробовали его коктейли в @goodkarma.bar. А ещё он любит активный отдых и не прочь исколесить весь город на велосипеде или съездить в горы покататься на сноуборде.<br><br>Парусный спорт стал частью его жизни ещё в детстве, без которой не может себя представить сегодня. Как говорит сам Андрей: «Стоит мне только выйти на воду, как всю усталость, стресс, тревоги уносит ветром и остается только улыбка. А теперь у меня появилась возможность рассказать и показать это всем, кто приходит к нам. И это замечательно!»<br><br>Если хотите зарядиться позитивной энергией, улыбаться и научиться управлять яхтой, смело записывайтесь к Андрею.')">
                                <div class="instructors__thumb">
                                    <img class="instructors__img" src="./assets/img/instructors/3.jpg" alt="">
                                    <div class="instructors-slide__text">
                                        <div class="instructors-slide__name">Харченко Андрей</div>
                                    </div>
                                </div>
                            </div>

                            <div class="swiper-slide instructors-slide"
                                onclick="openPopup('./assets/img/instructors/4.jpg', 'Горнушкин Максим', 'Макс пришёл в парусный спорт ещё ребёнком. В его школе набирали детей в парусную секцию и Макса это очень заинтересовало. Да настолько, что он теперь не представляет свою жизнь без воды, ветра и парусов. Можно сказать, что вода течёт по венам Макса, потому что кроме парусного спорта он ещё и пловец с первым взрослым разрядом. Летом он любит исследовать город на велосипеде, а зимой оттачивает мастерство на сноуборде.<br><br>Мастер на все руки — это про него. Макс строит себе загородный дом, где все делает своими руками. Мы, если честно, очень ждём, когда он его достроит и позовёт нас на новоселье. А ещё именно Макс провёл электричество в нашем домике-раздевалке.')">
                                <div class="instructors__thumb">
                                    <img class="instructors__img" src="./assets/img/instructors/4.jpg" alt="">
                                    <div class="instructors-slide__text">
                                        <div class="instructors-slide__name">Горнушкин Максим</div>
                                    </div>
                                </div>
                            </div>


                            <div class="swiper-slide instructors-slide"
                                onclick="openPopup('./assets/img/instructors/5.jpg', 'Бабкин Андрей', 'Андрей — воспитанник ярославского парусного клуба. Вместе с Глебом и Максом из прошлых выпусков они с детства покоряют волжский ветер. В парусный спорт он пришел благодаря сарафанному радио и сейчас уверенно передаёт накопленные знания нам. Он рад, что не забросил это дело будучи ребёнком, ведь жизнь яхтсмена наполнена приключениями и знакомствами. Андрей — самый весёлый инструктор в нашей команде, с ним постоянно происходят забавные истории.<br><br>В жизни Андрея есть три больших любви — паруса, гейминг и еда. В свободное время он не прочь зарубиться в видеоигры с Максом, а потом приготовить картофельного пюре по уникальному рецепту (вы даже не представляете, насколько это вкусно!). А ещё Андрей поклонник джаза и делится с нами своими музыкальными находками.<br><br>Его любимая часть в тренировочном процессе — прохождение под мостами между опор. Эти места очень коварны, потому что опоры перекрывают поток ветра. Нужно большое мастерство и опыт, чтобы заложить правильный вираж при подходе к мостам, при этом учитывая ветровые перепады и течение Волги')">
                                <div class="instructors__thumb">
                                    <img class="instructors__img" src="./assets/img/instructors/5.jpg" alt="">
                                    <div class="instructors-slide__text">
                                        <div class="instructors-slide__name">Бабкин Андрей</div>
                                    </div>
                                </div>
                            </div>

                            <div class="swiper-slide instructors-slide"
                                onclick="openPopup('./assets/img/instructors/6.jpg', 'Чупрасов Максим', 'Это Макс — он пришёл в парусный спорт в детстве, как и многие наши ребята. Этим летом Макс в паре с героем нашего прошлого выпуска Глебом стал победителем ярославского этапа Студенческой Парусной Лиги. А ещё Макс привёл к победе экипаж @utrocoffeespace в недавней гастрорегате — перенимайте у него гоночный опыт и спортивные секреты.<br><br>Макс обожает сильный ветер, чтобы летать по волжским волнам и чувствовать, как лодка гудит и почти взмывает в космос. Кроме того, он любит изучать современные технологии и путешествовать. Больше всего ему понравилось на Сицилии.<br><br>Макс может рассказать не только о тонкостях работы с парусами и рулём во время порывов, но и поделиться фирменным рецептом карбонары — всё уговариваем его сделать ужин на базе после гонки.')">
                                <div class="instructors__thumb">
                                    <img class="instructors__img" src="./assets/img/instructors/6.jpg" alt="">
                                    <div class="instructors-slide__text">
                                        <div class="instructors-slide__name">Чупрасов Максим</div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="slider-buttons">
                        <div class="instructors-slider-btn swiper-button-prev"></div>
                        <div class="instructors-slider-btn swiper-button-next"></div>
                    </div>
                </div>
            </div>

            <div class="overlay" id="overlay">
                <div class="popup" id="popup">
                    <svg id="close-btn" class="close" onclick="closePopup()" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z" />
                    </svg>
                    <div class="popup__content">
                        <div class="popup__img">
                            <img src="" id="popup-image" alt="">
                        </div>
                        <div class="popup__text">
                            <h3 class="popup-title" id="popup-title"></h3>
                            <p class="popup-description" id="popup-description"></p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="windy" id="windy">
            <div class="windy__container">
                <div class="windy__wrapper">
                    <h2 class="windy__title">Прогноз погоды от Windy</h2>
                    <iframe width="100%" height="600"
                        src="https://embed.windy.com/embed.html?type=map&location=coordinates&metricRain=default&metricTemp=default&metricWind=default&zoom=11&overlay=wind&product=ecmwf&level=surface&lat=57.596&lon=39.913&detailLat=57.61709494379496&detailLon=39.91058349609375&detail=true&message=true"
                        frameborder="0"></iframe>
                </div>
            </div>
        </section>

        <section class="contact" id="contact">
            <div class="contact__container">
                <div class="contact__title">Контакты</div>
                <div class="contact__wrapper">
                    <div class="contact__text">
                        <div class="contact__address">
                            <h3 class="contact__address__text">Как добраться</h3>
                            <p class="contact__address__desk">г.Ярославль,Тверицкая наб., 82А</p>
                        </div>
                        <div class="contact__communication">
                            <h4 class="contact__communication__text">Как с нами связаться:</h4>
                            <ul class="contact__communication__desk">
                                <li class="contact__communication__item"><img src="./assets/img/icon/contact_icon/phone.png"
                                        alt="" width="16" height="16"> <a href="tel:+79036917117">+7 (903) 691-71-17</a>
                                </li>
                                <li class="contact__communication__item"><img src="./assets/img/icon/contact_icon/mail.png"
                                        alt="" width="16" height="16"> <a
                                        href="mailto:yaryacht@yandex.ru">yaryacht@yandex.ru</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <iframe
                        src="https://yandex.ru/map-widget/v1/?um=constructor%3Adbbffd324fd861644c0ac63e0bf77dca578113d5170c3033bb95c1bed8550624&amp;source=constructor"
                        width="100%" height="350" frameborder="0"></iframe>
                </div>
            </div>
        </section>

    </main>
    <?php include("app/include/footer.php"); ?>


<!-- -------------   JS   ------------- -->
<script src="./assets/js/animation.js"></script>
<script src="./assets/js/header.js"></script>
<script src="./assets/js/swiper.js"></script>
<script src="./assets/js/lordicon.js"></script>
<script src="./assets/js/home/index.js"></script>
<!-- -----------   END JS   ----------- -->

</body>
</html>