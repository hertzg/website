<?php

namespace Users\Notes\Received;

function importCopy ($mysqli, $receivedNote, $insertApiKey = null) {

    $tags = $receivedNote->tags;

    include_once __DIR__.'/../../../Tags/parse.php';
    $tag_names = \Tags\parse($tags);

    include_once __DIR__.'/../add.php';
    return \Users\Notes\add($mysqli,
        $receivedNote->receiver_id_users, $receivedNote->text,
        $tags, $tag_names, $receivedNote->encrypt_in_listings, $insertApiKey);

}
