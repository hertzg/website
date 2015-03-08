<?php

namespace Contacts;

function maxLengths () {

    $fnsDir = __DIR__.'/..';

    include_once "$fnsDir/Tags/maxLength.php";
    include_once "$fnsDir/TagsJson/maxLength.php";
    include_once "$fnsDir/Username/maxLength.php";
    return [
        'address' => 128,
        'alias' => 32,
        'notes' => 1024 * 2,
        'phone1' => 32,
        'phone2' => 32,
        'tags' => \Tags\maxLength(),
        'tags_json' => \TagsJson\maxLength(),
        'username' => \Username\maxLength(),
    ];

}
