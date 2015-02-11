<?php

namespace Users\Places\Received;

function importCopy ($mysqli, $receivedPlace, $insertApiKey = null) {

    $tags = $receivedPlace->tags;

    include_once __DIR__.'/../../../Tags/parse.php';
    $tag_names = \Tags\parse($tags);

    include_once __DIR__.'/../add.php';
    return \Users\Places\add($mysqli, $receivedPlace->receiver_id_users,
        $receivedPlace->latitude, $receivedPlace->longitude,
        $receivedPlace->altitude, $receivedPlace->name,
        $tags, $tag_names, $insertApiKey);

}
