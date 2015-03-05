<?php

namespace ReceivedFolders;

function ensure ($mysqli) {

    $fnsDir = __DIR__.'/..';

    include_once "$fnsDir/Folders/maxLengths.php";
    $maxLengths = \Folders\maxLengths();

    include_once "$fnsDir/Table/ensure.php";
    include_once "$fnsDir/Username/column.php";
    return \Table\ensure($mysqli, 'received_folders', [
        'archived' => [
            'type' => 'tinyint(3) unsigned',
        ],
        'committed' => [
            'type' => 'tinyint(3) unsigned',
        ],
        'id' => [
            'type' => 'bigint(20) unsigned',
            'primary' => true,
        ],
        'insert_time' => [
            'type' => 'bigint(20) unsigned',
        ],
        'name' => [
            'type' => "varchar($maxLengths[name])",
            'characterSet' => 'utf8',
            'collation' => 'utf8_unicode_ci',
        ],
        'receiver_id_users' => [
            'type' => 'bigint(20) unsigned',
        ],
        'sender_id_users' => [
            'type' => 'bigint(20) unsigned',
        ],
        'sender_username' => \Username\column(),
    ]);

}
