<?php

namespace Users\DeletedItems;

function get ($mysqli, $user, $id) {

    if (!$user->num_deleted_items) return;

    include_once __DIR__.'/../../DeletedItems/getOnUser.php';
    return \DeletedItems\getOnUser($mysqli, $user->id_users, $id);

}
