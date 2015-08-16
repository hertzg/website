<?php

function require_invitation ($mysqli) {

    $fnsDir = __DIR__.'/../../../fns';

    include_once __DIR__.'/../../fns/require_admin.php';
    require_admin();

    include_once "$fnsDir/request_strings.php";
    list($id) = request_strings('id');

    $id = abs((int)$id);

    include_once "$fnsDir/Invitations/get.php";
    $invitation = Invitations\get($mysqli, $id);

    if (!$invitation) {
        $_SESSION['admin/invitations/errors'] = ['The invitation no longer exists.'];
        unset($_SESSION['admin/invitations/messages']);
        include_once "$fnsDir/redirect.php";
        redirect('..');
    }

    return [$invitation, $id];

}
