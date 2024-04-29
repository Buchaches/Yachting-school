<div class="sidebar" id="sidebar">
    <div class="sidebar__profile">
        <div class="profile__card">
            <div class="profile__img">
                <lord-icon src="https://cdn.lordicon.com/hrjifpbq.json" trigger="click" colors="primary:#1b62b3" style="width:100px;height:100px"></lord-icon>
            </div>
            <div class="profile__text">
                <p class="profile__text__title"><?=$_SESSION["name"] ?></p>
                <p class="profile__text__subtitle"><?=$_SESSION["email"] ?></p>
            </div>
        </div>
    </div>
    <div class="sidebar__menu">
        <ul>
            <li>
                <a class="menu__link" href="<?php echo BASE_URL . 'client/index.php'?>">
                    <div class="menu__link__item">
                        <svg class="sidebar__icon" xmlns="http://www.w3.org/2000/svg" fill="#1a1a1a" height="24" viewBox="0 -960 960 960" width="24"><path d="M280-280h80v-200h-80v200Zm320 0h80v-400h-80v400Zm-160 0h80v-120h-80v120Zm0-200h80v-80h-80v80ZM200-120q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h560q33 0 56.5 23.5T840-760v560q0 33-23.5 56.5T760-120H200Zm0-80h560v-560H200v560Zm0-560v560-560Z"/></svg>
                        <p class="menu__link__text">Главная</p>
                    </div> 
                </a>
            </li>
            <li>
                <a class="menu__link" href="<?php echo BASE_URL . 'client/bookings.php'?>">
                    <div class="menu__link__item">
                        <svg class="sidebar__icon" xmlns="http://www.w3.org/2000/svg" fill="#1a1a1a" height="24" viewBox="0 -960 960 960" width="24"><path d="M480-80q-75 0-140.5-28.5t-114-77q-48.5-48.5-77-114T120-440q0-75 28.5-140.5t77-114q48.5-48.5 114-77T480-800q75 0 140.5 28.5t114 77q48.5 48.5 77 114T840-440q0 75-28.5 140.5t-77 114q-48.5 48.5-114 77T480-80Zm0-360Zm112 168 56-56-128-128v-184h-80v216l152 152ZM224-866l56 56-170 170-56-56 170-170Zm512 0 170 170-56 56-170-170 56-56ZM480-160q117 0 198.5-81.5T760-440q0-117-81.5-198.5T480-720q-117 0-198.5 81.5T200-440q0 117 81.5 198.5T480-160Z"/></svg>
                        <p class="menu__link__text">Покупки</p>
                    </div> 
                </a>
            </li>
            <li>
                <a class="menu__link" href="<?php echo BASE_URL . 'client/settings.php'?>">
                    <div class="menu__link__item">
                        <svg class="sidebar__icon" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#1a1a1a"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M19.43 12.98c.04-.32.07-.64.07-.98 0-.34-.03-.66-.07-.98l2.11-1.65c.19-.15.24-.42.12-.64l-2-3.46c-.09-.16-.26-.25-.44-.25-.06 0-.12.01-.17.03l-2.49 1c-.52-.4-1.08-.73-1.69-.98l-.38-2.65C14.46 2.18 14.25 2 14 2h-4c-.25 0-.46.18-.49.42l-.38 2.65c-.61.25-1.17.59-1.69.98l-2.49-1c-.06-.02-.12-.03-.18-.03-.17 0-.34.09-.43.25l-2 3.46c-.13.22-.07.49.12.64l2.11 1.65c-.04.32-.07.65-.07.98 0 .33.03.66.07.98l-2.11 1.65c-.19.15-.24.42-.12.64l2 3.46c.09.16.26.25.44.25.06 0 .12-.01.17-.03l2.49-1c.52.4 1.08.73 1.69.98l.38 2.65c.03.24.24.42.49.42h4c.25 0 .46-.18.49-.42l.38-2.65c.61-.25 1.17-.59 1.69-.98l2.49 1c.06.02.12.03.18.03.17 0 .34-.09.43-.25l2-3.46c.12-.22.07-.49-.12-.64l-2.11-1.65zm-1.98-1.71c.04.31.05.52.05.73 0 .21-.02.43-.05.73l-.14 1.13.89.7 1.08.84-.7 1.21-1.27-.51-1.04-.42-.9.68c-.43.32-.84.56-1.25.73l-1.06.43-.16 1.13-.2 1.35h-1.4l-.19-1.35-.16-1.13-1.06-.43c-.43-.18-.83-.41-1.23-.71l-.91-.7-1.06.43-1.27.51-.7-1.21 1.08-.84.89-.7-.14-1.13c-.03-.31-.05-.54-.05-.74s.02-.43.05-.73l.14-1.13-.89-.7-1.08-.84.7-1.21 1.27.51 1.04.42.9-.68c.43-.32.84-.56 1.25-.73l1.06-.43.16-1.13.2-1.35h1.39l.19 1.35.16 1.13 1.06.43c.43.18.83.41 1.23.71l.91.7 1.06-.43 1.27-.51.7 1.21-1.07.85-.89.7.14 1.13zM12 8c-2.21 0-4 1.79-4 4s1.79 4 4 4 4-1.79 4-4-1.79-4-4-4zm0 6c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2z"/></svg>
                        <p class="menu__link__text">Настройки</p>
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