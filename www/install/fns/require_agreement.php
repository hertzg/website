<?php

function require_agreement () {

    include_once __DIR__.'/require_not_installed.php';
    require_not_installed('../');

    if (!array_key_exists('install/agreement/accepted', $_SESSION)) {
        include_once __DIR__.'/../../fns/redirect.php';
        redirect('../agreement/');
    }

}
