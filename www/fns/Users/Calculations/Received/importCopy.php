<?php

namespace Users\Calculations\Received;

function importCopy ($mysqli,
    $receivedCalculation, $depends, $insertApiKey = null) {

    $tags = $receivedCalculation->tags;
    $expression = $receivedCalculation->expression;

    include_once __DIR__.'/../../../Tags/parse.php';
    $tag_names = \Tags\parse($tags);

    include_once __DIR__.'/../add.php';
    return \Users\Calculations\add($mysqli,
        $receivedCalculation->receiver_id_users,
        $expression, $receivedCalculation->title, $tags, $tag_names,
        $receivedCalculation->value, $receivedCalculation->error,
        $receivedCalculation->error_char, $expression, $depends, $insertApiKey);

}
