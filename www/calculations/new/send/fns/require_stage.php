<?php

function require_stage ($base = '') {

    $fnsDir = __DIR__.'/../../../../fns';

    include_once "$fnsDir/require_user.php";
    $user = require_user("$base../../../");

    $key = 'calculations/new/send/calculation';
    if (!array_key_exists($key, $_SESSION)) {
        include_once "$fnsDir/redirect.php";
        include_once "$fnsDir/ItemList/pageQuery.php";
        redirect("$base../".ItemList\pageQuery());
    }

    return [$user, $_SESSION[$key]];

}
