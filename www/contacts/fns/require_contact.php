<?php

function require_contact ($mysqli) {

    $fnsDir = __DIR__.'/../../fns';

    include_once "$fnsDir/require_user.php";
    $user = require_user('../../');

    include_once "$fnsDir/request_strings.php";
    list($id) = request_strings('id');

    $id = abs((int)$id);

    include_once "$fnsDir/Contacts/getOnUser.php";
    $contact = Contacts\getOnUser($mysqli, $user->id_users, $id);

    if (!$contact) {
        unset($_SESSION['contacts/messages']);
        $_SESSION['contacts/errors'] = [
            'The contact no longer exists.',
        ];
        include_once "$fnsDir/redirect.php";
        redirect('..');
    }

    return [$contact, $id, $user];

}
