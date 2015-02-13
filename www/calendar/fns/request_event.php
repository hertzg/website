<?php

function request_event ($mysqli, &$user, &$id, &$event) {

    $fnsDir = __DIR__.'/../../fns';

    include_once "$fnsDir/require_user.php";
    $user = require_user('../../');

    include_once "$fnsDir/request_strings.php";
    list($id) = request_strings('id');

    $id = abs((int)$id);

    include_once "$fnsDir/Events/getOnUser.php";
    $event = Events\getOnUser($mysqli, $user->id_users, $id);

}
