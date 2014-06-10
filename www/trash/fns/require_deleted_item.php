<?php

function require_deleted_item ($mysqli) {

    $fnsDir = __DIR__.'/../../fns';

    include_once "$fnsDir/require_user.php";
    $user = require_user('../../');

    include_once "$fnsDir/request_strings.php";
    list($id) = request_strings('id');

    $id = abs((int)$id);

    include_once "$fnsDir/DeletedItems/getOnUser.php";
    $deletedItem = DeletedItems\getOnUser($mysqli, $user->id_users, $id);

    if (!$deletedItem) {
        include_once "$fnsDir/redirect.php";
        redirect('..');
    }

    return [$deletedItem, $id, $user];

}
