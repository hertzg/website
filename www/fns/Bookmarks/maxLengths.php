<?php

namespace Bookmarks;

function maxLengths () {
    $fnsDir = __DIR__.'/..';
    include_once "$fnsDir/Tags/maxLength.php";
    include_once "$fnsDir/TagsJson/maxLength.php";
    return [
        'tags' => \Tags\maxLength(),
        'tags_json' => \TagsJson\maxLength(),
        'title' => 128,
        'url' => 2048,
    ];
}
