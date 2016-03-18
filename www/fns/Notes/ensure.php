<?php

namespace Notes;

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

    $textLength = $maxLengths['text'];
    $titleLength = $maxLengths['title'];

    include_once "$fnsDir/Crypto/encryptedLength.php";
    $encrypted_text_length = \Crypto\encryptedLength($textLength);
    $encrypted_title_length = \Crypto\encryptedLength($titleLength);

    include_once "$fnsDir/Table/ensure.php";
    include_once "$fnsDir/Tags/column.php";
    include_once "$fnsDir/TagsJson/column.php";
    return \Table\ensure($mysqli, 'notes', [
        'encrypt_in_listings' => ['type' => 'tinyint(3) unsigned'],
        'encrypted_text' => [
            'type' => "varbinary($encrypted_text_length)",
            'nullable' => true,
        ],
        'encrypted_text_iv' => [
            'type' => 'bigint(20) unsigned',
            'nullable' => true,
        ],
        'encrypted_title' => [
            'type' => "varbinary($encrypted_title_length)",
            'nullable' => true,
        ],
        'encrypted_title_iv' => [
            'type' => 'bigint(20) unsigned',
            'nullable' => true,
        ],
        'id' => [
            'type' => 'bigint(20) unsigned',
            'primary' => true,
        ],
        'id_users' => ['type' => 'bigint(20) unsigned'],
        'insert_api_key_id' => $nullable_unsigned_bigint,
        'insert_api_key_name' => $apiKeyNameColumn,
        'insert_time' => ['type' => 'bigint(20) unsigned'],
        'num_tags' => ['type' => 'tinyint(3) unsigned'],
        'password_protect' => ['type' => 'tinyint(3) unsigned'],
        'revision' => ['type' => 'bigint(20) unsigned'],
        'tags' => \Tags\column(),
        'tags_json' => \TagsJson\column(),
        'text' => [
            'type' => "varchar($textLength)",
            'characterSet' => 'utf8',
            'collation' => 'utf8_unicode_ci',
        ],
        'title' => [
            'type' => "varchar($titleLength)",
            'characterSet' => 'utf8',
            'collation' => 'utf8_unicode_ci',
        ],
        'update_api_key_id' => $nullable_unsigned_bigint,
        'update_api_key_name' => $apiKeyNameColumn,
        'update_time' => ['type' => 'bigint(20) unsigned'],
    ]);

}
