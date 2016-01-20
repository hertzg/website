<?php

namespace Users\Account\Close;

function deleteContacts ($mysqli, $user) {

    $id_users = $user->id_users;
    $fnsDir = __DIR__.'/../../..';

    if ($user->num_contacts) {

        include_once "$fnsDir/Contacts/deleteOnUser.php";
        \Contacts\deleteOnUser($mysqli, $id_users);

        include_once "$fnsDir/ContactTags/deleteOnUser.php";
        \ContactTags\deleteOnUser($mysqli, $id_users);

        include_once "$fnsDir/ContactRevisions/deleteOnUser.php";
        \ContactRevisions\deleteOnUser($mysqli, $id_users);

    }

    if ($user->num_received_contacts) {
        include_once "$fnsDir/ReceivedContacts/deleteOnReceiver.php";
        \ReceivedContacts\deleteOnReceiver($mysqli, $id_users);
    }

}
