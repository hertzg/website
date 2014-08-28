<?php

function require_first_stage () {

    $fnsDir = __DIR__.'/../../../../fns';

    include_once "$fnsDir/require_user.php";
    $user = require_user('../../../');

    $key = 'schedules/new/next/first_stage';
    if (!array_key_exists($key, $_SESSION)) {
        include_once "$fnsDir/redirect.php";
        include_once "$fnsDir/ItemList/pageQuery.php";
        redirect('../'.ItemList\pageQuery());
    }

    return [$user, $_SESSION[$key]];

}
