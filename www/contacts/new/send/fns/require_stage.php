<?php

function require_stage ($base = '') {

    $fnsDir = __DIR__.'/../../../../fns';

    include_once "$fnsDir/require_user.php";
    $user = require_user("$base../../../");

    $key = 'contacts/new/values';
    if (!array_key_exists($key, $_SESSION)) {
        include_once "$fnsDir/redirect.php";
        redirect("$base..");
    }

    return [$user, $_SESSION[$key]];

}
