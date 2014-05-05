<?php

namespace Users\Contacts;

function add ($mysqli, $id_users, $full_name, $alias, $address, $email,
    $phone1, $phone2, $birthday_time, $username, $tags, $tag_names, $favorite) {

    include_once __DIR__.'/../../Contacts/add.php';
    $id = \Contacts\add($mysqli, $id_users, $full_name, $alias, $address,
        $email, $phone1, $phone2, $birthday_time, $username, $tags, $favorite);

    include_once __DIR__.'/../../ContactTags/add.php';
    \ContactTags\add($mysqli, $id_users, $id,
        $tag_names, $full_name, $alias, $favorite);

    return $id;

}
