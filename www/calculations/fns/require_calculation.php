<?php

function require_calculation ($mysqli, $base = '') {

    $fnsDir = __DIR__.'/../../fns';

    include_once "$fnsDir/require_user.php";
    $user = require_user("$base../../");

    include_once "$fnsDir/request_strings.php";
    list($id) = request_strings('id');

    $id = abs((int)$id);

    include_once "$fnsDir/Users/Calculations/get.php";
    $calculation = Users\Calculations\get($mysqli, $user, $id);

    if (!$calculation) {
        unset($_SESSION['calculations/messages']);
        $_SESSION['calculations/errors'] = [
            'The calculation no longer exists.',
        ];
        include_once "$fnsDir/redirect.php";
        redirect("$base..");
    }

    return [$calculation, $id, $user];

}
