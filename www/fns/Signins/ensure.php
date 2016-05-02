<?php

namespace Signins;

function ensure ($mysqli) {

    $fnsDir = __DIR__.'/..';

    include_once "$fnsDir/IPAddress/column.php";
    include_once "$fnsDir/Table/ensure.php";
    include_once "$fnsDir/UserAgent/column.php";
    return \Table\ensure($mysqli, 'signins', [
        'id' => [
            'type' => 'bigint(20) unsigned',
            'primary' => true,
        ],
        'id_users' => ['type' => 'bigint(20) unsigned'],
        'insert_time' => ['type' => 'bigint(20) unsigned'],
        'remote_address' => \IPAddress\column(),
        'user_agent' => \UserAgent\column(),
    ]);

}
