<?php

namespace Calculations;

function maxLengths () {

    $fnsDir = __DIR__.'/..';

    include_once "$fnsDir/Tags/maxLength.php";
    include_once "$fnsDir/TagsJson/maxLength.php";
    return [
        'expression' => 1024,
        'tags' => \Tags\maxLength(),
        'tags_json' => \TagsJson\maxLength(),
        'title' => 128,
    ];

}
