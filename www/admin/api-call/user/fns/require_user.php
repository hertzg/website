<?php

function require_user ($mysqli) {

    $fnsDir = __DIR__.'/../../../../fns';

    include_once "$fnsDir/request_strings.php";
    list($id) = request_strings('id');

    $id = abs((int)$id);

    include_once "$fnsDir/Users/get.php";
    $user = Users\get($mysqli, $id);

    if (!$user) {
        include_once "$fnsDir/ErrorJson/badRequest.php";
        ErrorJson\badRequest('"USER_NOT_FOUND"');
    }

    return $user;

}
