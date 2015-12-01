<?php

namespace Users\Calculations\Received;

function importCopy ($mysqli, $receivedCalculation, $insertApiKey = null) {

    $tags = $receivedCalculation->tags;

    include_once __DIR__.'/../../../Tags/parse.php';
    $tag_names = \Tags\parse($tags);

    include_once __DIR__.'/../add.php';
    return \Users\Calculations\add($mysqli,
        $receivedCalculation->receiver_id_users,
        $receivedCalculation->expression,
        $receivedCalculation->title, $tags, $tag_names, $insertApiKey);

}
