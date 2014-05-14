<?php

function require_stage () {

    include_once __DIR__.'/../../../../fns/require_user.php';
    $user = require_user('../../../');

    $key = 'notes/new/values';
    if (!array_key_exists($key, $_SESSION)) {
        include_once __DIR__.'/../../../../fns/redirect.php';
        redirect('..');
    }

    return [$user, $_SESSION[$key]];

}
