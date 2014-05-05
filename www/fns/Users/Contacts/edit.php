<?php

namespace Users\Contacts;

function edit ($mysqli, $id_users, $id, $full_name, $alias, $address, $email,
    $phone1, $phone2, $birthday_time, $username, $tags, $tag_names, $favorite) {

    include_once __DIR__.'/../../Contacts/edit.php';
    \Contacts\edit($mysqli, $id_users, $id, $full_name, $alias, $address, $email,
        $phone1, $phone2, $birthday_time, $username, $tags, $favorite);

    include_once __DIR__.'/../../ContactTags/deleteOnContact.php';
    \ContactTags\deleteOnContact($mysqli, $id);

    include_once __DIR__.'/../../ContactTags/add.php';
    \ContactTags\add($mysqli, $id_users, $id,
        $tag_names, $full_name, $alias, $favorite);

}
