<?php
/** @var string $login */
?>
<main>
    <!-- user panel-->
    <div class="user-panel">
        <span class="user-greeting">Hi,
            <a class="settings-hyperlink" href="#" title="open settings page"><?= $login ?></a>
        </span>
        <button class="logout-btn" title="Logout">
            <img src="/public/img/logout-icon.svg" alt="Logout" width="16" height="16">
        </button>
    </div>

    <!-- popup window create new dashboard-->
    <div class="absolute-center popup-win hidden" id="popup-window-create-new-dashboard">
        <div class="cross" id="popup-window-create-new-dashboard-cross">X</div>
<!--        TODO: fill in-->
    </div>

    <div class="container">
        <nav id="CSV-Graphs">
            <h1 class="CSV-Graphs-title">Your generated financial statements</h1>
            <div class="CSV-Graphs-title-btns">
                <button class="create-new-dashboard">Create a New Dashboard</button>
            </div>
            <ul>
                <li>{{Some CSV Graph}}</li>
                <li>{{Some CSV Graph}}</li>
                <li>{{Some CSV Graph}}</li>
            </ul>
        </nav>
    </div>
</main>
<script src="/public/js/home/home.js"></script>