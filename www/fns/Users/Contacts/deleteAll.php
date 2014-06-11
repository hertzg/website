<?php

namespace Users\Contacts;

function deleteAll ($mysqli, $id_users) {

    $fnsDir = __DIR__.'/../..';

    include_once "$fnsDir/Contacts/indexOnUser.php";
    $contacts = \Contacts\indexOnUser($mysqli, $id_users);

    if ($contacts) {
        include_once "$fnsDir/DeletedItems/Contacts/add.php";
        foreach ($contacts as $contact) {
            \DeletedItems\Contacts\add($mysqli, $contact);
        }
    }

    include_once "$fnsDir/Contacts/deleteOnUser.php";
    \Contacts\deleteOnUser($mysqli, $id_users);

    include_once "$fnsDir/ContactTags/deleteOnUser.php";
    \ContactTags\deleteOnUser($mysqli, $id_users);

    include_once "$fnsDir/../fns/time_today.php";
    $birthdays_check_day = time_today();
    $sql = 'update users set num_contacts = 0,'
        .' num_birthdays_today = 0, num_birthdays_tomorrow = 0,'
        ." birthdays_check_day = $birthdays_check_day"
        ." where id_users = $id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);

}
