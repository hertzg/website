<?php

namespace Users\Contacts\Received;

function import ($mysqli, $user, $receivedContact) {

    $tags = $receivedContact->tags;

    include_once __DIR__.'/../../../Tags/parse.php';
    $tag_names = \Tags\parse($tags);

    include_once __DIR__.'/../add.php';
    $id = \Users\Contacts\add($mysqli, $user, $receivedContact->full_name,
        $receivedContact->alias, $receivedContact->address,
        $receivedContact->email, $receivedContact->phone1,
        $receivedContact->phone2, $receivedContact->birthday_time,
        $receivedContact->username, $tags, $tag_names,
        $receivedContact->favorite);

    include_once __DIR__.'/delete.php';
    delete($mysqli, $receivedContact);

    return $id;

}
