<?php

function request_invitation ($mysqli) {

    $fnsDir = __DIR__.'/../../fns';

    include_once "$fnsDir/require_guest_user.php";
    require_guest_user('../');

    include_once "$fnsDir/request_strings.php";
    list($key) = request_strings('key');

    include_once "$fnsDir/Invitations/getByKey.php";
    $invitation = Invitations\getByKey($mysqli, $key);

    return [$invitation, $key];

}
