<?php

namespace Users\Contacts\Received;

function add ($mysqli, $sender_id_users, $sender_username, $receiver_id_users,
    $full_name, $alias, $address, $email, $phone1, $phone2, $birthday_time,
    $username, $tags, $favorite) {

    include_once __DIR__.'/../../../ReceivedContacts/add.php';
    \ReceivedContacts\add($mysqli, $sender_id_users, $sender_username,
        $receiver_id_users, $full_name, $alias, $address, $email, $phone1,
        $phone2, $birthday_time, $username, $tags, $favorite);

    include_once __DIR__.'/addNumberNew.php';
    addNumberNew($mysqli, $receiver_id_users, 1);

}
