<?php
/** @var string $login */
?>
<main>
    <div class="user-panel">
        <span class="user-greeting">Hi,
            <a class="settings-hyperlink" href="#" title="open settings page"><?= $login ?></a>
        </span>
        <button class="logout-btn" title="Logout">
            <img src="/public/img/logout-icon.svg" alt="Logout" width="16" height="16">
        </button>
    </div>
    <div class="container">
        <nav id="CSV-Graphs">
            <h1 class="CSV-Graphs-title">Your generated financial statements</h1>
            <div class="CSV-Graphs-title-btns">
                <button class="create-new-graph">Create a New Note</button>
                <button class="Load-graph">Load a Note</button>
            </div>
            <ul>
                <li>{{Some CSV Graph}}</li>
                <li>{{Some CSV Graph}}</li>
                <li>{{Some CSV Graph}}</li>
            </ul>
        </nav>
    </div>
</main>