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
        'email1_label' => 10,
        'email2_label' => 10,
        'notes' => 1024 * 2,
        'phone1' => 32,
        'phone1_label' => 10,
        'phone2' => 32,
        'phone2_label' => 10,
        'tags' => \Tags\maxLength(),
        'tags_json' => \TagsJson\maxLength(),
        'username' => \UsernameAddress\maxLength(),
    ];

}
