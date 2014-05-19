<?php

namespace Users\Notes\Received;

function import ($mysqli, $receivedNote) {

    $tags = $receivedNote->tags;

    include_once __DIR__.'/../../../Tags/parse.php';
    $tag_names = \Tags\parse($tags);

    include_once __DIR__.'/../add.php';
    $id = \Users\Notes\add($mysqli, $receivedNote->receiver_id_users,
        $receivedNote->text, $tags, $tag_names);

    include_once __DIR__.'/delete.php';
    delete($mysqli, $receivedNote);

    return $id;

}
