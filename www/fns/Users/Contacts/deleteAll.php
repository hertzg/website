<?php

namespace Users\Contacts;

function deleteAll ($mysqli, $id_users) {

    include_once __DIR__.'/../../Contacts/deleteOnUser.php';
    \Contacts\deleteOnUser($mysqli, $id_users);

    include_once __DIR__.'/../../ContactTags/deleteOnUser.php';
    \ContactTags\deleteOnUser($mysqli, $id_users);

    include_once __DIR__.'/../../../fns/time_today.php';
    $birthdays_check_day = time_today();
    $sql = 'update users set num_contacts = 0,'
        .' num_birthdays_today = 0, num_birthdays_tomorrow = 0,'
        ." birthdays_check_day = $birthdays_check_day"
        ." where id_users = $id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);

}
