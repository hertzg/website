<?php

namespace Users\Contacts;

function search ($mysqli, $user, $keyword) {

    if (!$user->num_contacts) return [];

    include_once __DIR__.'/../../Contacts/search.php';
    return \Contacts\search($mysqli, $user->id_users, $keyword);

}
