<?php

function request_invitation ($mysqli) {

    $fnsDir = __DIR__.'/../../fns';

    include_once "$fnsDir/require_guest_user.php";
    require_guest_user('../');

    include_once "$fnsDir/request_strings.php";
    list($id) = request_strings('id');

    $id = abs((int)$id);

    include_once "$fnsDir/LinkKey/request.php";
    $key = LinkKey\request();

    include_once "$fnsDir/Invitations/getByKey.php";
    $invitation = Invitations\getByKey($mysqli, $id, $key);

    return [$invitation, $key, $id];

}
