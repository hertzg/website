<?php

function require_contact ($mysqli, $base = '') {

    $fnsDir = __DIR__.'/../../fns';

    include_once "$fnsDir/require_user.php";
    $user = require_user("$base../../");

    include_once "$fnsDir/request_strings.php";
    list($id) = request_strings('id');

    $id = abs((int)$id);

    include_once "$fnsDir/Users/Contacts/get.php";
    $contact = Users\Contacts\get($mysqli, $user, $id);

    if (!$contact) {
        unset($_SESSION['contacts/messages']);
        $_SESSION['contacts/errors'] = ['The contact no longer exists.'];
        include_once "$fnsDir/redirect.php";
        redirect("$base..");
    }

    return [$contact, $id, $user];

}
