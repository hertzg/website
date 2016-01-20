<?php

namespace NoteRevisions;

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
    include_once "$fnsDir/Tags/column.php";
    return \Table\ensure($mysqli, 'note_revisions', [
        'deleted' => ['type' => 'tinyint(3) unsigned'],
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
        'id_notes' => [
            'type' => 'bigint(20) unsigned',
        ],
        'id_users' => ['type' => 'bigint(20) unsigned'],
        'insert_time' => ['type' => 'bigint(20) unsigned'],
        'password_protect' => ['type' => 'tinyint(3) unsigned'],
        'revision' => ['type' => 'bigint(20) unsigned'],
        'tags' => \Tags\column(),
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
    ]);

}
