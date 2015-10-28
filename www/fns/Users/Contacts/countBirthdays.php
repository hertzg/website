<?php

namespace Users\Contacts;

function countBirthdays ($mysqli, $user, $day, $month, $year) {

    if (!$user->num_contacts) return 0;

    include_once __DIR__.'/../../Contacts/countBirthdays.php';
    return \Contacts\countBirthdays($mysqli,
        $user->id_users, $day, $month, $year);

}
