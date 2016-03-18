<?php

namespace Calculations;

function ensure ($mysqli) {

    include_once __DIR__.'/maxLengths.php';
    $maxLengths = maxLengths();

    $fnsDir = __DIR__.'/..';

    $nullable_unsigned_bigint = [
        'type' => 'bigint(20) unsigned',
        'nullable' => true,
    ];

    include_once "$fnsDir/ApiKeyName/column.php";
    $apiKeyNameColumn = \ApiKeyName\column(true);

    include_once "$fnsDir/Table/ensure.php";
    include_once "$fnsDir/Tags/column.php";
    include_once "$fnsDir/TagsJson/column.php";
    return \Table\ensure($mysqli, 'calculations', [
        'error' => [
            'type' => "varchar($maxLengths[error])",
            'characterSet' => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'nullable' => true,
        ],
        'error_char' => [
            'type' => 'bigint(20) unsigned',
            'nullable' => true,
        ],
        'expression' => [
            'type' => "varchar($maxLengths[expression])",
            'characterSet' => 'utf8',
            'collation' => 'utf8_unicode_ci',
        ],
        'id' => [
            'type' => 'bigint(20) unsigned',
            'primary' => true,
        ],
        'id_users' => ['type' => 'bigint(20) unsigned'],
        'insert_api_key_id' => $nullable_unsigned_bigint,
        'insert_api_key_name' => $apiKeyNameColumn,
        'insert_time' => ['type' => 'bigint(20) unsigned'],
        'num_depends' => ['type' => 'tinyint(3) unsigned'],
        'num_tags' => ['type' => 'tinyint(3) unsigned'],
        'resolved_expression' => [
            'type' => "varchar($maxLengths[expression])",
            'characterSet' => 'utf8',
            'collation' => 'utf8_unicode_ci',
        ],
        'revision' => ['type' => 'bigint(20) unsigned'],
        'tags' => \Tags\column(),
        'tags_json' => \TagsJson\column(),
        'title' => [
            'type' => "varchar($maxLengths[title])",
            'characterSet' => 'utf8',
            'collation' => 'utf8_unicode_ci',
        ],
        'update_api_key_id' => $nullable_unsigned_bigint,
        'update_api_key_name' => $apiKeyNameColumn,
        'update_time' => ['type' => 'bigint(20) unsigned'],
        'value' => [
            'type' => 'double',
            'nullable' => true,
        ],
    ]);

}
