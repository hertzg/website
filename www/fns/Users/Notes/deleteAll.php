<?php

namespace Users\Notes;

function deleteAll ($mysqli, $id_users) {

    include_once __DIR__.'/../../Notes/deleteOnUser.php';
    \Notes\deleteOnUser($mysqli, $id_users);

    include_once __DIR__.'/../../NoteTags/deleteOnUser.php';
    \NoteTags\deleteOnUser($mysqli, $id_users);

    include_once __DIR__.'/clearNumber.php';
    clearNumber($mysqli, $id_users);

}
