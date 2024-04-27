<div class="sidebar" id="sidebar">
    <div class="sidebar__profile">
        <div class="profile__card">
            <div class="profile__img">
                <lord-icon src="https://cdn.lordicon.com/hrjifpbq.json" trigger="click" colors="primary:#1b62b3" style="width:100px;height:100px"></lord-icon>
            </div>
            <div class="profile__text">
                <p class="profile__text__title">Админ</p>
                <p class="profile__text__subtitle"><?=$_SESSION["email"] ?></p>
            </div>
        </div>
    </div>
    <div class="sidebar__menu">
        <ul>
            <li>
                <a class="menu__link" href="<?php echo BASE_URL . 'admin/index.php'?>">
                    <div class="menu__link__item">
                        <svg class="sidebar__icon" xmlns="http://www.w3.org/2000/svg" fill="#1a1a1a" height="24" viewBox="0 -960 960 960" width="24"><path d="M280-280h80v-200h-80v200Zm320 0h80v-400h-80v400Zm-160 0h80v-120h-80v120Zm0-200h80v-80h-80v80ZM200-120q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h560q33 0 56.5 23.5T840-760v560q0 33-23.5 56.5T760-120H200Zm0-80h560v-560H200v560Zm0-560v560-560Z"/></svg>
                        <p class="menu__link__text">Статистика</p>
                    </div> 
                </a>
            </li>
            <li>
                <a class="menu__link" href="<?php echo BASE_URL . 'admin/bookings.php'?>">
                    <div class="menu__link__item">
                        <svg class="sidebar__icon" xmlns="http://www.w3.org/2000/svg" fill="#1a1a1a" height="24" viewBox="0 -960 960 960" width="24"><path d="M480-80q-75 0-140.5-28.5t-114-77q-48.5-48.5-77-114T120-440q0-75 28.5-140.5t77-114q48.5-48.5 114-77T480-800q75 0 140.5 28.5t114 77q48.5 48.5 77 114T840-440q0 75-28.5 140.5t-77 114q-48.5 48.5-114 77T480-80Zm0-360Zm112 168 56-56-128-128v-184h-80v216l152 152ZM224-866l56 56-170 170-56-56 170-170Zm512 0 170 170-56 56-170-170 56-56ZM480-160q117 0 198.5-81.5T760-440q0-117-81.5-198.5T480-720q-117 0-198.5 81.5T200-440q0 117 81.5 198.5T480-160Z"/></svg>
                        <p class="menu__link__text">Покупки</p>
                    </div> 
                </a>
            </li>
            <li>
                <a class="menu__link" href="<?php echo BASE_URL . 'admin/timeslots.php'?>">
                    <div class="menu__link__item">
                        <svg class="sidebar__icon" xmlns="http://www.w3.org/2000/svg" fill="#1a1a1a" height="24" viewBox="0 -960 960 960" width="24"><path d="M200-120v-640q0-33 23.5-56.5T280-840h400q33 0 56.5 23.5T760-760v640L480-240 200-120Zm80-122 200-86 200 86v-518H280v518Zm0-518h400-400Z"/></svg>
                        <p class="menu__link__text">Слоты</p>
                    </div> 
                </a>
            </li>
            <li>
                <a class="menu__link" href="<?php echo BASE_URL . 'admin/clients.php'?>">
                    <div class="menu__link__item">
                        <svg class="sidebar__icon" xmlns="http://www.w3.org/2000/svg" fill="#1a1a1a" height="24" viewBox="0 -960 960 960" width="24"><path d="M360-80v-529q-91-24-145.5-100.5T160-880h80q0 83 53.5 141.5T430-680h100q30 0 56 11t47 32l181 181-56 56-158-158v478h-80v-240h-80v240h-80Zm120-640q-33 0-56.5-23.5T400-800q0-33 23.5-56.5T480-880q33 0 56.5 23.5T560-800q0 33-23.5 56.5T480-720Z"/></svg>
                        <p class="menu__link__text">Клиенты</p>
                    </div> 
                </a>
            </li>
            <li>
                <a class="menu__link" href="<?php echo BASE_URL . 'admin/instructors.php'?>">
                    <div class="menu__link__item">
                        <svg class="sidebar__icon" xmlns="http://www.w3.org/2000/svg" fill="#1a1a1a" height="24" viewBox="0 -960 960 960" width="24"><path d="M160-160v-280 280Zm640 0v-280 280Zm-40-480q17 0 28.5-11.5T800-680q0-17-11.5-28.5T760-720q-17 0-28.5 11.5T720-680q0 17 11.5 28.5T760-640Zm0 80q-51 0-85.5-34.5T640-680q0-50 34.5-85t85.5-35q50 0 85 35t35 85q0 51-35 85.5T760-560ZM480-680q25 0 42.5-17t17.5-43q0-25-17.5-42.5T480-800q-26 0-43 17.5T420-740q0 26 17 43t43 17Zm0 80q-59 0-99.5-40.5T340-740q0-58 40.5-99t99.5-41q58 0 99 41t41 99q0 59-41 99.5T480-600ZM320-425q0 30 32 70t128 127q94-85 127-125t33-72q0-23-15-39t-37-16q-14 0-26.5 6T541-457l-48 57h-27l-48-57q-8-11-20.5-17t-25.5-6q-23 0-37.5 16T320-425Zm-80 0q0-53 36-94t96-41q31 0 59.5 14t48.5 38q20-24 48-38t60-14q60 0 96 41.5t36 93.5q0 53-38.5 104.5T524-160l-44 40-44-40Q315-270 277.5-321T240-425Zm-40-215q17 0 28.5-11.5T240-680q0-17-11.5-28.5T200-720q-17 0-28.5 11.5T160-680q0 17 11.5 28.5T200-640ZM483-80v-80h317v-280H682v-80h118q33 0 56.5 23.5T880-440v360H483Zm-323-80h323v80H80v-360q0-33 23-56.5t57-23.5h118v80H160v280Zm40-400q-51 0-85.5-34.5T80-680q0-50 34.5-85t85.5-35q50 0 85 35t35 85q0 51-35 85.5T200-560Zm280-180Zm-280 60Zm560 0Z"/></svg>
                        <p class="menu__link__text">Инструкторы</p>
                    </div>
                </a>
            </li>
            <li>
                <a class="menu__link home__link" href="<?php echo BASE_URL?>">
                    <div class="menu__link__item">
                    <svg class="sidebar__icon" xmlns="http://www.w3.org/2000/svg" fill="#1a1a1a" height="24" viewBox="0 -960 960 960" width="24"><path d="M240-200h120v-240h240v240h120v-360L480-740 240-560v360Zm-80 80v-480l320-240 320 240v480H520v-240h-80v240H160Zm320-350Z"/></svg>
                        <p class="menu__link__text">На главную</p>
                    </div>
                </a>
            </li>
            <li>
                <a class="menu__link" href="<?php echo BASE_URL . 'logout.php'?>">
                    <div class="menu__link__item">
                        <svg class="sidebar__icon" xmlns="http://www.w3.org/2000/svg" fill="#1a1a1a" height="24" viewBox="0 -960 960 960" width="24"><path d="M520-40v-240l-84-80-40 176-276-56 16-80 192 40 64-324-72 28v136h-80v-188l158-68q35-15 51.5-19.5T480-720q21 0 39 11t29 29l40 64q26 42 70.5 69T760-520v80q-66 0-123.5-27.5T540-540l-24 120 84 80v300h-80Zm20-700q-33 0-56.5-23.5T460-820q0-33 23.5-56.5T540-900q33 0 56.5 23.5T620-820q0 33-23.5 56.5T540-740Z"/></svg>
                        <p class="menu__link__text">Выход</p>
                    </div>
                </a>
            </li>
        </ul>
    </div>
</div>