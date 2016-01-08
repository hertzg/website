<?php

namespace Users\Contacts\Received;

function add ($mysqli, $sender_id_users, $sender_username,
    $receiver_id_users, $full_name, $alias, $address, $email1,
    $email1_label, $email2, $email2_label, $phone1, $phone1_label,
    $phone2, $phone2_label, $birthday_time, $username, $timezone,
    $tags, $notes, $favorite, $photo_id, $sender_address = null) {

    $fnsDir = __DIR__.'/../../..';

    include_once "$fnsDir/ReceivedContacts/add.php";
    \ReceivedContacts\add($mysqli, $sender_address, $sender_id_users,
        $sender_username, $receiver_id_users, $full_name, $alias,
        $address, $email1, $email1_label, $email2, $email2_label,
        $phone1, $phone1_label, $phone2, $phone2_label, $birthday_time,
        $username, $timezone, $tags, $notes, $favorite, $photo_id);

    if ($photo_id) {
        include_once "$fnsDir/ContactPhotos/addRef.php";
        \ContactPhotos\addRef($mysqli, $photo_id);
    }

    $sql = 'update users set'
        .' num_received_contacts = num_received_contacts + 1,'
        .' home_num_new_received_contacts = home_num_new_received_contacts + 1'
        ." where id_users = $receiver_id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);

}
