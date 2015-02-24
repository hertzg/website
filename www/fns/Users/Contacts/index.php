<?php

namespace Users\Contacts;

function index ($mysqli, $user) {

    if (!$user->num_contacts) return [];

    include_once __DIR__.'/../../Contacts/indexOnUser.php';
    return \Contacts\indexOnUser($mysqli, $user->id_users);

}
