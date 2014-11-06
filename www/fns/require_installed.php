<?php

function require_installed ($base = '') {
    include_once __DIR__.'/installed.php';
    if (!installed()) {
        include_once __DIR__.'/redirect.php';
        redirect("{$base}install/");
    }
}
