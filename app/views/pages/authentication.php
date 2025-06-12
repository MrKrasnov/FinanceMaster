<?php
use App\Models\Authentication;
/** @var Authentication $model */
?>
<div class="flex-container-form">
    <div class="container">
        <div class="form-container">
            <div class="switch-buttons">
                <button id="loginBtn" class="active">Sign In</button>
                <button id="registerBtn">Sign Up</button>
            </div>
            <div id="forms">
                <form id="loginForm" class="form active">
                    <h2>Sign In</h2>
                    <input type="hidden" name="token" value="<?= $model->csrfToken ?>">
                    <input type="text" placeholder="Login or Email" required>
                    <input type="password" placeholder="Password" required>
                    <button type="submit">Login</button>
                </form>
                <form id="registerForm" class="form">
                    <h2>Sign Up</h2>
                    <input type="hidden" name="token" value="<?= $model->csrfToken ?>">
                    <input type="text" name="login" placeholder="Login" required>
                    <input type="email" name="email" placeholder="Email" required>
                    <input type="password" name="password" placeholder="Password" required>
                    <input type="password" name="repeat-password" placeholder="Repeat Password" required>
                    <button type="submit">Register</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="/public/js/authentication/authentication.js"></script>