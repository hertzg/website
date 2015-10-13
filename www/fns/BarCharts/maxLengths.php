<?php

namespace BarCharts;

function maxLengths () {

    $fnsDir = __DIR__.'/..';

    include_once "$fnsDir/Tags/maxLength.php";
    include_once "$fnsDir/TagsJson/maxLength.php";
    return [
        'name' => 64,
        'tags' => \Tags\maxLength(),
        'tags_json' => \TagsJson\maxLength(),
    ];

}
