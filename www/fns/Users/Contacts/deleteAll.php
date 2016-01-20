<?php

namespace Users\Contacts;

function deleteAll ($mysqli, $user, $apiKey = null) {

    if (!$user->num_contacts) return;

    $id_users = $user->id_users;
    $fnsDir = __DIR__.'/../..';

    include_once "$fnsDir/Contacts/indexOnUser.php";
    $contacts = \Contacts\indexOnUser($mysqli, $id_users);

    if ($contacts) {
        include_once __DIR__.'/../DeletedItems/addContact.php';
        foreach ($contacts as $contact) {
            \Users\DeletedItems\addContact($mysqli, $contact, $apiKey);
        }
    }

    include_once "$fnsDir/Contacts/deleteOnUser.php";
    \Contacts\deleteOnUser($mysqli, $id_users);

    include_once "$fnsDir/ContactRevisions/setDeletedOnUser.php";
    \ContactRevisions\setDeletedOnUser($mysqli, $id_users, true);

    include_once "$fnsDir/ContactTags/deleteOnUser.php";
    \ContactTags\deleteOnUser($mysqli, $id_users);

    include_once "$fnsDir/../fns/user_time_today.php";
    $birthdays_check_day = user_time_today($user);
    $sql = 'update users set num_contacts = 0,'
        .' num_birthdays_today = 0, num_birthdays_tomorrow = 0,'
        ." birthdays_check_day = $birthdays_check_day"
        ." where id_users = $id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);

}
