<?php

namespace NoteTags;

function ensure ($mysqli) {

    $fnsDir = __DIR__.'/..';

    include_once "$fnsDir/Notes/maxLengths.php";
    $maxLengths = \Notes\maxLengths();

    $textLength = $maxLengths['text'];
    $titleLength = $maxLengths['title'];

    include_once "$fnsDir/Crypto/encryptedLength.php";
    $encrypted_text_length = \Crypto\encryptedLength($textLength);
    $encrypted_title_length = \Crypto\encryptedLength($titleLength);

    include_once "$fnsDir/Table/ensure.php";
    include_once "$fnsDir/TagName/column.php";
    include_once "$fnsDir/Tags/column.php";
    include_once "$fnsDir/TagsJson/column.php";
    return \Table\ensure($mysqli, 'note_tags', [
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
        'id_notes' => ['type' => 'bigint(20) unsigned'],
        'id_users' => ['type' => 'bigint(20) unsigned'],
        'insert_time' => ['type' => 'bigint(20) unsigned'],
        'num_tags' => ['type' => 'tinyint(3) unsigned'],
        'password_protect' => ['type' => 'tinyint(3) unsigned'],
        'tags' => \Tags\column(),
        'tags_json' => \TagsJson\column(),
        'tag_name' => \TagName\column(),
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
        'update_time' => ['type' => 'bigint(20) unsigned'],
    ]);

}
