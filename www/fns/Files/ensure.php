<?php

namespace Files;

function ensure ($mysqli) {

    $fnsDir = __DIR__.'/..';

    include_once "$fnsDir/ApiKeyName/column.php";
    $apiKeyNameColumn = \ApiKeyName\column(true);

    include_once "$fnsDir/ContentType/column.php";
    include_once "$fnsDir/FileName/column.php";
    include_once "$fnsDir/MediaType/column.php";
    include_once "$fnsDir/Table/ensure.php";
    return \Table\ensure($mysqli, 'files', [
        'content_revision' => ['type' => 'bigint(20) unsigned'],
        'content_type' => \ContentType\column(),
        'hashes_computed' => ['type' => 'tinyint(3) unsigned'],
        'id_files' => [
            'type' => 'bigint(20) unsigned',
            'primary' => true,
        ],
        'id_folders' => ['type' => 'bigint(20) unsigned'],
        'id_users' => ['type' => 'bigint(20) unsigned'],
        'insert_api_key_id' => [
            'type' => 'bigint(20) unsigned',
            'nullable' => true,
        ],
        'insert_api_key_name' => $apiKeyNameColumn,
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
        'rename_api_key_id' => [
            'type' => 'bigint(20) unsigned',
            'nullable' => true,
        ],
        'rename_api_key_name' => $apiKeyNameColumn,
        'rename_time' => ['type' => 'bigint(20) unsigned'],
        'revision' => ['type' => 'bigint(20) unsigned'],
        'sha256_sum' => [
            'type' => 'binary(64)',
            'nullable' => true,
        ],
        'size' => ['type' => 'bigint(20) unsigned'],
    ]);

}
