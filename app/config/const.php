<?php
const RELATIVE_LOG_PATH = __DIR__ . "/../../../logs/";

if (!is_dir(RELATIVE_LOG_PATH)) {
    if (!mkdir(RELATIVE_LOG_PATH, 0755, true)) {
        error_log('Error: Failed to create log directory: ' . RELATIVE_LOG_PATH);
    }
}

define("REQUEST_URI", $_SERVER['REQUEST_URI']);
define("USER_AGENT", $_SERVER['HTTP_USER_AGENT']);