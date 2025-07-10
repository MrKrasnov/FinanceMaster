<?php
use App\Models\Authentication;
/** @var \App\Core\Manager\CsrfTokenManager $csrfTokenManager */
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
                    <input type="hidden" name="<?= $csrfTokenManager->csrfTokenNameKey ?>" value="<?= $csrfTokenManager->csrfToken ?>">
                    <input type="text" name="username" placeholder="Login or Email" required>
                    <input type="password" name="password" placeholder="Password" required>
                    <button type="submit">Login</button>
                </form>
                <form id="registerForm" class="form">
                    <input type="hidden" name="<?= $csrfTokenManager->csrfTokenNameKey ?>" value="<?= $csrfTokenManager->csrfToken ?>">
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