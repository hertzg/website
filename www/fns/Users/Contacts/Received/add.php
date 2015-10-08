<?php

namespace Users\Contacts\Received;

function add ($mysqli, $sender_id_users, $sender_username,
    $receiver_id_users, $full_name, $alias, $address, $email1, $email2,
    $phone1, $phone1_label, $phone2, $phone2_label, $birthday_time,
    $username, $timezone, $tags, $notes, $favorite, $photo_id) {

    $fnsDir = __DIR__.'/../../..';

    include_once "$fnsDir/ReceivedContacts/add.php";
    \ReceivedContacts\add($mysqli, $sender_id_users, $sender_username,
        $receiver_id_users, $full_name, $alias, $address, $email1, $email2,
        $phone1, $phone1_label, $phone2, $phone2_label, $birthday_time,
        $username, $timezone, $tags, $notes, $favorite, $photo_id);

    if ($photo_id) {
        include_once "$fnsDir/ContactPhotos/addRef.php";
        \ContactPhotos\addRef($mysqli, $photo_id);
    }

    include_once __DIR__.'/addNumberNew.php';
    addNumberNew($mysqli, $receiver_id_users, 1);

}
