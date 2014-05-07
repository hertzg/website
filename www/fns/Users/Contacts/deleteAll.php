<?php

namespace Users\Contacts;

function deleteAll ($mysqli, $id_users) {

    include_once __DIR__.'/../../Contacts/deleteOnUser.php';
    \Contacts\deleteOnUser($mysqli, $id_users);

    include_once __DIR__.'/../../ContactTags/deleteOnUser.php';
    \ContactTags\deleteOnUser($mysqli, $id_users);

    include_once __DIR__.'/clearNumber.php';
    clearNumber($mysqli, $id_users);

}
