<?php

namespace ReceivedFolderFiles;

function ensure ($mysqli) {

    $fnsDir = __DIR__.'/..';

    include_once "$fnsDir/FileName/column.php";
    $nameColumn = \FileName\column();

    include_once "$fnsDir/ContentType/column.php";
    include_once "$fnsDir/MediaType/column.php";
    include_once "$fnsDir/Table/ensure.php";
    return \Table\ensure($mysqli, 'received_folder_files', [
        'content_type' => \ContentType\column(),
        'deleted' => ['type' => 'tinyint(3) unsigned'],
        'hashes_computed' => ['type' => 'tinyint(3) unsigned'],
        'id' => [
            'type' => 'bigint(20) unsigned',
            'primary' => true,
        ],
        'id_received_folders' => ['type' => 'bigint(20) unsigned'],
        'id_users' => ['type' => 'bigint(20) unsigned'],
        'md5_sum' => [
            'type' => 'binary(32)',
            'nullable' => true,
        ],
        'media_type' => \MediaType\column(),
        'name' => $nameColumn,
        'parent_id' => ['type' => 'bigint(20) unsigned'],
        'readable_size' => [
            'type' => 'varchar(20)',
            'characterSet' => 'utf8',
            'collation' => 'utf8_unicode_ci',
        ],
        'received_folder_name' => $nameColumn,
        'sha256_sum' => [
            'type' => 'binary(64)',
            'nullable' => true,
        ],
        'size' => ['type' => 'bigint(20) unsigned'],
    ]);

}
