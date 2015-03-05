<?php

namespace Files;

function ensure ($mysqli) {

    include_once __DIR__.'/maxLengths.php';
    $maxLengths = maxLengths();

    $fnsDir = __DIR__.'/..';

    include_once "$fnsDir/MediaType/column.php";
    include_once "$fnsDir/Table/ensure.php";
    return \Table\ensure($mysqli, 'files', [
        'content_revision' => [
            'type' => 'bigint(20) unsigned',
        ],
        'content_type' => [
            'type' => "varchar($maxLengths[content_type])",
            'characterSet' => 'ascii',
            'collation' => 'ascii_bin',
        ],
        'id_files' => [
            'type' => 'bigint(20) unsigned',
            'primary' => true,
        ],
        'id_folders' => [
            'type' => 'bigint(20) unsigned',
        ],
        'id_users' => [
            'type' => 'bigint(20) unsigned',
        ],
        'insert_api_key_id' => [
            'type' => 'bigint(20) unsigned',
            'nullable' => true,
        ],
        'insert_api_key_name' => [
            'type' => "varchar($maxLengths[insert_api_key_name])",
            'nullable' => true,
            'characterSet' => 'utf8',
            'collation' => 'utf8_general_ci',
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
        'rename_api_key_id' => [
            'type' => 'bigint(20) unsigned',
            'nullable' => true,
        ],
        'rename_api_key_name' => [
            'type' => "varchar($maxLengths[rename_api_key_name])",
            'nullable' => true,
            'characterSet' => 'utf8',
            'collation' => 'utf8_general_ci',
        ],
        'rename_time' => [
            'type' => 'bigint(20) unsigned',
        ],
        'revision' => [
            'type' => 'bigint(20) unsigned',
        ],
        'size' => [
            'type' => 'bigint(20) unsigned',
        ],
    ]);

}
