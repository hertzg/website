<?php

function require_deleted_item ($mysqli, $base = '') {

    $fnsDir = __DIR__.'/../../fns';

    include_once "$fnsDir/require_user.php";
    $user = require_user("$base../");

    include_once "$fnsDir/request_strings.php";
    list($id) = request_strings('id');

    $id = abs((int)$id);

    include_once "$fnsDir/DeletedItems/getOnUser.php";
    $deletedItem = DeletedItems\getOnUser($mysqli, $user->id_users, $id);

    if (!$deletedItem) {
        include_once "$fnsDir/redirect.php";
        unset($_SESSION['trash/messages']);
        $_SESSION['trash/errors'] = ['The item no longer exists.'];
        redirect("$base./");
    }

    return [$deletedItem, $id, $user];

}
