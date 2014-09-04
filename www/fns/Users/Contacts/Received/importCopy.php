<?php

namespace Users\Contacts\Received;

function importCopy ($mysqli, $user, $receivedContact) {

    $tags = $receivedContact->tags;

    include_once __DIR__.'/../../../Tags/parse.php';
    $tag_names = \Tags\parse($tags);

    include_once __DIR__.'/../add.php';
    return \Users\Contacts\add($mysqli, $user, $receivedContact->full_name,
        $receivedContact->alias, $receivedContact->address,
        $receivedContact->email, $receivedContact->phone1,
        $receivedContact->phone2, $receivedContact->birthday_time,
        $receivedContact->username, $receivedContact->timezone,
        $tags, $tag_names, $receivedContact->favorite);

}
