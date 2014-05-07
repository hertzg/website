<?php

namespace Users\Tasks;

function deleteAll ($mysqli, $id_users) {

    include_once __DIR__.'/../../Tasks/deleteOnUser.php';
    \Tasks\deleteOnUser($mysqli, $id_users);

    include_once __DIR__.'/../../TaskTags/deleteOnUser.php';
    \TaskTags\deleteOnUser($mysqli, $id_users);

    include_once __DIR__.'/clearNumber.php';
    clearNumber($mysqli, $id_users);

}
