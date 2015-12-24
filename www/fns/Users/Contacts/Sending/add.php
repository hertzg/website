<?php

namespace Users\Contacts\Sending;

function add ($mysqli, $user, $recipient, $full_name, $alias,
    $address, $email1, $email1_label, $email2, $email2_label,
    $phone1, $phone1_label, $phone2, $phone2_label, $birthday_time,
    $username, $timezone, $tags, $notes, $favorite) {

    include_once __DIR__.'/../../../SendingContacts/add.php';
    \SendingContacts\add($mysqli, $user->id_users,
        $user->username, $recipient['username'],
        $recipient['address'], $recipient['id_admin_connections'],
        $recipient['their_exchange_api_key'], $full_name, $alias,
        $address, $email1, $email1_label, $email2, $email2_label,
        $phone1, $phone1_label, $phone2, $phone2_label, $birthday_time,
        $username, $timezone, $tags, $notes, $favorite);

}
