<?php

function require_received_calculations ($base = '') {

    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/require_user.php";
    $user = require_user("$base../../");

    if (!$user->num_received_calculations) {
        $_SESSION['calculations/messages'] = ['No more received calculations.'];
        unset($_SESSION['calculations/errors']);
        include_once "$fnsDir/redirect.php";
        redirect("$base..");
    }

    return $user;

}
