<?php

function require_invitation ($mysqli) {

    $fnsDir = __DIR__.'/../../../../fns';

    include_once "$fnsDir/request_strings.php";
    list($id) = request_strings('id');

    $id = abs((int)$id);

    include_once "$fnsDir/Invitations/get.php";
    $invitation = Invitations\get($mysqli, $id);

    if (!$invitation) {
        include_once __DIR__.'/../../fns/bad_request.php';
        bad_request('INVITATION_NOT_FOUND');
    }

    return $invitation;

}
