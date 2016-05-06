<?php

function request_valid_key ($mysqli) {

    $fnsDir = __DIR__.'/../../fns';

    include_once "$fnsDir/require_guest_user.php";
    require_guest_user('../');

    include_once "$fnsDir/request_strings.php";
    list($key) = request_strings('key');

    include_once "$fnsDir/Users/getByResetPasswordKey.php";
    $user = Users\getByResetPasswordKey($mysqli, $key);

    return [$user, $key];

}
