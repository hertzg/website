<?php

namespace Invitations;

function ensure ($mysqli) {

    $fnsDir = __DIR__.'/..';

    include_once "$fnsDir/Email/column.php";
    include_once "$fnsDir/LinkKey/column.php";
    include_once "$fnsDir/Table/ensure.php";
    return \Table\ensure($mysqli, 'invalid_signins', [
        'email' => \Email\column(),
        'id' => [
            'type' => 'bigint(20) unsigned',
            'primary' => true,
        ],
        'insert_time' => ['type' => 'bigint(20) unsigned'],
        'key' => \LinkKey\column(),
    ]);

}
