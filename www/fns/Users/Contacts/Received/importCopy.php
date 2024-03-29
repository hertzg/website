<?php

namespace Users\Contacts\Received;

function importCopy ($mysqli, $user, $receivedContact, $insertApiKey = null) {

    $tags = $receivedContact->tags;

    include_once __DIR__.'/../../../Tags/parse.php';
    $tag_names = \Tags\parse($tags);

    include_once __DIR__.'/../add.php';
    return \Users\Contacts\add($mysqli, $user, $receivedContact->full_name,
        $receivedContact->alias, $receivedContact->address,
        $receivedContact->email1, $receivedContact->email1_label,
        $receivedContact->email2, $receivedContact->email2_label,
        $receivedContact->phone1, $receivedContact->phone1_label,
        $receivedContact->phone2, $receivedContact->phone2_label,
        $receivedContact->birthday_time, $receivedContact->username,
        $receivedContact->timezone, $tags, $tag_names,
        $receivedContact->notes, $receivedContact->favorite,
        $receivedContact->photo_id, $insertApiKey);

}
