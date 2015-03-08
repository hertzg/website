<?php

namespace Schedules;

function maxLengths () {

    $fnsDir = __DIR__.'/..';

    include_once "$fnsDir/Tags/maxLength.php";
    include_once "$fnsDir/TagsJson/maxLength.php";
    return [
        'tags' => \Tags\maxLength(),
        'tags_json' => \TagsJson\maxLength(),
        'text' => 1024,
    ];

}
