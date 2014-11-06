<?php

function require_not_installed ($base = '') {

    $fnsDir = __DIR__.'/../../fns';

    include_once "$fnsDir/installed.php";
    if (installed()) {
        include_once "$fnsDir/redirect.php";
        redirect("$base..");
    }

    include_once "$fnsDir/session_start_custom.php";
    session_start_custom();

}
