<?php
use App\Models\Authentication;
/** @var Authentication $model */
?>
<main class="container-tiny">
    <div class="authentication-flex flex justify-content-center">
        <div>
            <h3>Sign In</h3>
            <form action="#" method="POST">
                <input type="hidden" name="token" value="<?= $model->csrfToken ?>">
                <input class="authentication-input" type="text" name="E-mail" placeholder="example@gmail.com">
                <input class="authentication-input" type="password" name="pass" placeholder="password">
                <input id="sign-in" type="submit">
            </form>
        </div>
        <div>
            <h3>Sign Up</h3>
            <form action="#" method="POST">
                <input type="hidden" name="token" value="<?= $model->csrfToken ?>">
                <input class="authentication-input" type="text" name="E-mail">
                <input class="authentication-input" type="password" name="pass" placeholder="password">
                <input class="authentication-input" type="password" name="repeat-pass" placeholder="repeat password">
                <input id="sign-up" type="submit">
            </form>
        </div>
    </div>
</main>
