<?php

function require_stage () {

    $fnsDir = __DIR__.'/../../../../fns';

    include_once "$fnsDir/require_user.php";
    $user = require_user('../../../');

    $key = 'bookmarks/new/values';
    if (!array_key_exists($key, $_SESSION)) {
        include_once "$fnsDir/redirect.php";
        redirect('..');
    }

    return [$user, $_SESSION[$key]];

}
