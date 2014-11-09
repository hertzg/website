<?php

function require_installed ($base = '') {
    include_once __DIR__.'/Installed/get.php';
    if (!Installed\get()) {
        include_once __DIR__.'/redirect.php';
        redirect("{$base}install/");
    }
}
