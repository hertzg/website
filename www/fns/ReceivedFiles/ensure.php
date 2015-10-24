<?php

namespace ReceivedFiles;

function ensure ($mysqli) {

    $fnsDir = __DIR__.'/..';

    include_once "$fnsDir/ContentType/column.php";
    include_once "$fnsDir/FileName/column.php";
    include_once "$fnsDir/MediaType/column.php";
    include_once "$fnsDir/Table/ensure.php";
    include_once "$fnsDir/Username/column.php";
    return \Table\ensure($mysqli, 'received_files', [
        'archived' => ['type' => 'tinyint(3) unsigned'],
        'committed' => ['type' => 'tinyint(3) unsigned'],
        'content_type' => \ContentType\column(),
        'hashes_computed' => ['type' => 'tinyint(3) unsigned'],
        'id' => [
            'type' => 'bigint(20) unsigned',
            'primary' => true,
        ],
        'insert_time' => ['type' => 'bigint(20) unsigned'],
        'md5_sum' => [
            'type' => 'binary(32)',
            'nullable' => true,
        ],
        'media_type' => \MediaType\column(),
        'name' => \FileName\column(),
        'readable_size' => [
            'type' => 'varchar(20)',
            'characterSet' => 'utf8',
            'collation' => 'utf8_unicode_ci',
        ],
        'receiver_id_users' => ['type' => 'bigint(20) unsigned'],
        'sender_id_users' => ['type' => 'bigint(20) unsigned'],
        'sender_username' => \Username\column(),
        'sha256_sum' => [
            'type' => 'binary(64)',
            'nullable' => true,
        ],
        'size' => ['type' => 'bigint(20) unsigned'],
    ]);

}
