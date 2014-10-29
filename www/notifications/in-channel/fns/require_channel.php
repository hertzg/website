<?php

function require_channel ($mysqli, $base = '') {

    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/require_user.php";
    $user = require_user("$base../../");

    include_once "$fnsDir/request_strings.php";
    list($id) = request_strings('id');

    $id = abs((int)$id);

    include_once "$fnsDir/Channels/getOnUser.php";
    $channel = Channels\getOnUser($mysqli, $user->id_users, $id);

    if (!$channel) {
        unset($_SESSION['notifications/messages']);
        $_SESSION['notifications/errors'] = ['The channel no longer exists.'];
        include_once "$fnsDir/redirect.php";
        redirect("$base..");
    }

    return [$channel, $id, $user];

}
