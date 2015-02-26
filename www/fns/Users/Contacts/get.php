<?php

namespace Users\Contacts;

function get ($mysqli, $user, $id) {

    if (!$user->num_contacts) return;

    include_once __DIR__.'/../../Contacts/getOnUser.php';
    return \Contacts\getOnUser($mysqli, $user->id_users, $id);

}
