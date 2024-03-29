<?php

namespace Users\Contacts;

function send ($mysqli, $user, $receiver_id_users, $contact) {
    include_once __DIR__.'/Received/add.php';
    Received\add($mysqli, $user->id_users,
        $user->username, $receiver_id_users, $contact->full_name,
        $contact->alias, $contact->address, $contact->email1,
        $contact->email1_label, $contact->email2, $contact->email2_label,
        $contact->phone1, $contact->phone1_label, $contact->phone2,
        $contact->phone2_label, $contact->birthday_time, $contact->username,
        $contact->timezone, $contact->tags, $contact->notes,
        $contact->favorite, $contact->photo_id);
}
