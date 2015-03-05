<?php

namespace ReceivedFiles;

function ensure ($mysqli) {

    $fnsDir = __DIR__.'/..';

    include_once "$fnsDir/Files/maxLengths.php";
    $maxLengths = \Files\maxLengths();

    include_once "$fnsDir/ContentType/column.php";
    include_once "$fnsDir/MediaType/column.php";
    include_once "$fnsDir/Table/ensure.php";
    include_once "$fnsDir/Username/maxLength.php";
    return \Table\ensure($mysqli, 'received_files', [
        'archived' => [
            'type' => 'tinyint(3) unsigned',
        ],
        'committed' => [
            'type' => 'tinyint(3) unsigned',
        ],
        'content_type' => \ContentType\column(),
        'id' => [
            'type' => 'bigint(20) unsigned',
            'primary' => true,
        ],
        'insert_time' => [
            'type' => 'bigint(20) unsigned',
        ],
        'media_type' => \MediaType\column(),
        'name' => [
            'type' => "varchar($maxLengths[name])",
            'characterSet' => 'utf8',
            'collation' => 'utf8_unicode_ci',
        ],
        'readable_size' => [
            'type' => 'varchar(20)',
            'characterSet' => 'utf8',
            'collation' => 'utf8_unicode_ci',
        ],
        'receiver_id_users' => [
            'type' => 'bigint(20) unsigned',
        ],
        'sender_id_users' => [
            'type' => 'bigint(20) unsigned',
        ],
        'sender_username' => [
            'type' => 'varchar('.\Username\maxLength().')',
            'characterSet' => 'ascii',
            'collation' => 'ascii_bin',
        ],
        'size' => [
            'type' => 'bigint(20) unsigned',
        ],
    ]);

}
