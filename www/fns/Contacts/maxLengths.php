<?php

namespace Contacts;

function maxLengths () {

    $fnsDir = __DIR__.'/..';

    include_once "$fnsDir/Tags/maxLength.php";
    include_once "$fnsDir/TagsJson/maxLength.php";
    include_once "$fnsDir/UsernameAddress/maxLength.php";
    return [
        'address' => 128,
        'alias' => 32,
        'email_label' => 10,
        'notes' => 1024 * 2,
        'phone' => 32,
        'phone_label' => 10,
        'tags' => \Tags\maxLength(),
        'tags_json' => \TagsJson\maxLength(),
        'username' => \UsernameAddress\maxLength(),
    ];

}
