<?php

namespace Contacts;

function ensure ($mysqli) {

    include_once __DIR__.'/maxLengths.php';
    $maxLengths = maxLengths();

    $fnsDir = __DIR__.'/..';

    include_once "$fnsDir/ApiKeyName/column.php";
    $apiKeyNameColumn = \ApiKeyName\column(true);

    include_once "$fnsDir/Email/column.php";
    $emailColumn = \Email\column();

    $nullable_unsigned_bigint = [
        'type' => 'bigint(20) unsigned',
        'nullable' => true,
    ];

    include_once "$fnsDir/FullName/column.php";
    include_once "$fnsDir/Table/ensure.php";
    include_once "$fnsDir/Tags/column.php";
    include_once "$fnsDir/TagsJson/column.php";
    include_once "$fnsDir/UsernameAddress/column.php";
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
        'birthday_day' => $nullable_unsigned_bigint,
        'birthday_month' => $nullable_unsigned_bigint,
        'birthday_time' => [
            'type' => 'bigint(20)',
            'nullable' => true,
        ],
        'birthday_year' => $nullable_unsigned_bigint,
        'email1' => $emailColumn,
        'email1_label' => [
            'type' => "varchar($maxLengths[email1_label])",
            'characterSet' => 'utf8',
            'collation' => 'utf8_general_ci',
        ],
        'email2' => $emailColumn,
        'email2_label' => [
            'type' => "varchar($maxLengths[email2_label])",
            'characterSet' => 'utf8',
            'collation' => 'utf8_general_ci',
        ],
        'favorite' => ['type' => 'tinyint(3) unsigned'],
        'full_name' => \FullName\column(),
        'id' => [
            'type' => 'bigint(20) unsigned',
            'primary' => true,
        ],
        'id_users' => ['type' => 'bigint(20) unsigned'],
        'insert_api_key_id' => $nullable_unsigned_bigint,
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
        'phone1_label' => [
            'type' => "varchar($maxLengths[phone1_label])",
            'characterSet' => 'utf8',
            'collation' => 'utf8_general_ci',
        ],
        'phone2' => [
            'type' => "varchar($maxLengths[phone2])",
            'characterSet' => 'utf8',
            'collation' => 'utf8_general_ci',
        ],
        'phone2_label' => [
            'type' => "varchar($maxLengths[phone2_label])",
            'characterSet' => 'utf8',
            'collation' => 'utf8_general_ci',
        ],
        'photo_id' => $nullable_unsigned_bigint,
        'revision' => ['type' => 'bigint(20) unsigned'],
        'tags' => \Tags\column(),
        'tags_json' => \TagsJson\column(),
        'timezone' => [
            'type' => 'int(11)',
            'nullable' => true,
        ],
        'update_api_key_id' => $nullable_unsigned_bigint,
        'update_api_key_name' => $apiKeyNameColumn,
        'update_time' => ['type' => 'bigint(20) unsigned'],
        'username' => \UsernameAddress\column(),
    ]);

}
