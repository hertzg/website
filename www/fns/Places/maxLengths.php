<?php

namespace Places;

function maxLengths () {

    $fnsDir = __DIR__.'/..';

    include_once "$fnsDir/Tags/maxLength.php";
    include_once "$fnsDir/TagsJson/maxLength.php";
    return [
        'description' => 2 * 1024,
        'name' => 256,
        'tags' => \Tags\maxLength(),
        'tags_json' => \TagsJson\maxLength(),
    ];

}
