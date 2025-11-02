<?php
/** @var string $login
 *  @var array<\App\Dto\Dashboard> $dashboards
 *  @var \App\Core\Manager\CsrfTokenManager $csrfTokenManager
 * */
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
        <div class="popup-container" style="padding-top: 50px">
            <h2>Form create new dashboard</h2>
            <form id="createDashboardForm">
                <input type="text" name="title" placeholder="Title: Super dashboard family finance" maxlength="30">
                <input type="text" name="description" placeholder="Description: + cash + cash + cash = more cash hahaha :)" maxlength="100">
                <input type="hidden" name="owner" value="<?= $login ?>">
                <input type="hidden" name="<?= $csrfTokenManager->csrfTokenNameKey ?>" value="<?= $csrfTokenManager->csrfToken ?>">
                <button type="submit" id="push-for-create-dashboard">Push for create</button>
            </form>
        </div>
    </div>

    <div class="container">
        <nav id="CSV-Graphs">
            <h1 class="CSV-Graphs-title">Your generated financial statements</h1>
            <div class="CSV-Graphs-title-btns">
                <button class="create-new-dashboard">Create a New Dashboard</button>
            </div>
            <ul>
                <?php
                foreach($dashboards as $dashboard){
                    $dashboardTitle = $dashboard->getTitle();
                    $dashboardDescription = $dashboard->getDescription();
                    echo
                    "<li>
                        <p>Title: $dashboardTitle</p><br>
                        <p>Description: $dashboardDescription</p>
                    </li>";
                }
                ?>
            </ul>
        </nav>
    </div>
</main>
<script src="/public/js/home/home.js"></script>