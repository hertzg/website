<?php

namespace Contacts;

function ensure ($mysqli) {

    include_once __DIR__.'/maxLengths.php';
    $maxLengths = maxLengths();

    $fnsDir = __DIR__.'/..';

    include_once "$fnsDir/ApiKeyName/column.php";
    $apiKeyNameColumn = \ApiKeyName\column(true);

    include_once "$fnsDir/Email/column.php";
    include_once "$fnsDir/FullName/column.php";
    include_once "$fnsDir/Table/ensure.php";
    include_once "$fnsDir/Tags/column.php";
    include_once "$fnsDir/TagsJson/column.php";
    return \Table\ensure($mysqli, 'contacts', [
        'address' => [
            'type' => "varchar($maxLengths[address])",
            'characterSet' => 'utf8',
            'collation' => 'utf8_general_ci',
        ],
        'alias' => [
            'type' => "varchar($maxLengths[alias])",
            'characterSet' => 'utf8',
            'collation' => 'utf8_unicode_ci',
        ],
        'birthday_day' => [
            'type' => 'bigint(20) unsigned',
            'nullable' => true,
        ],
        'birthday_month' => [
            'type' => 'bigint(20) unsigned',
            'nullable' => true,
        ],
        'birthday_time' => [
            'type' => 'bigint(20)',
            'nullable' => true,
        ],
        'email' => \Email\column(),
        'favorite' => ['type' => 'tinyint(3) unsigned'],
        'full_name' => \FullName\column(),
        'id' => [
            'type' => 'bigint(20) unsigned',
            'primary' => true,
        ],
        'id_users' => ['type' => 'bigint(20) unsigned'],
        'insert_api_key_id' => [
            'type' => 'bigint(20) unsigned',
            'nullable' => true,
        ],
        'insert_api_key_name' => $apiKeyNameColumn,
        'insert_time' => ['type' => 'bigint(20) unsigned'],
        'notes' => [
            'type' => "varchar($maxLengths[notes])",
            'characterSet' => 'utf8',
            'collation' => 'utf8_general_ci',
        ],
        'num_tags' => ['type' => 'tinyint(3) unsigned'],
        'phone1' => [
            'type' => "varchar($maxLengths[phone1])",
            'characterSet' => 'utf8',
            'collation' => 'utf8_general_ci',
        ],
        'phone2' => [
            'type' => "varchar($maxLengths[phone2])",
            'characterSet' => 'utf8',
            'collation' => 'utf8_general_ci',
        ],
        'photo_id' => [
            'type' => 'bigint(20) unsigned',
            'nullable' => true,
        ],
        'revision' => ['type' => 'bigint(20) unsigned'],
        'tags' => \Tags\column(),
        'tags_json' => \TagsJson\column(),
        'timezone' => [
            'type' => 'int(11)',
            'nullable' => true,
        ],
        'update_api_key_id' => [
            'type' => 'bigint(20) unsigned',
            'nullable' => true,
        ],
        'update_api_key_name' => $apiKeyNameColumn,
        'update_time' => ['type' => 'bigint(20) unsigned'],
        'username' => [
            'type' => "varchar($maxLengths[username])",
            'characterSet' => 'ascii',
            'collation' => 'ascii_bin',
        ],
    ]);

}
