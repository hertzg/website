<?php

namespace ReceivedContacts;

function ensure ($mysqli) {

    $fnsDir = __DIR__.'/..';

    include_once "$fnsDir/Contacts/maxLengths.php";
    $maxLengths = \Contacts\maxLengths();

    include_once "$fnsDir/Email/column.php";
    include_once "$fnsDir/Table/ensure.php";
    include_once "$fnsDir/Username/column.php";
    return \Table\ensure($mysqli, 'received_contacts', [
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
        'archived' => ['type' => 'tinyint(3) unsigned'],
        'birthday_time' => [
            'type' => 'bigint(20) unsigned',
            'nullable' => true,
        ],
        'email' => \Email\column(),
        'favorite' => ['type' => 'tinyint(3) unsigned'],
        'full_name' => [
            'type' => "varchar($maxLengths[full_name])",
            'characterSet' => 'utf8',
            'collation' => 'utf8_unicode_ci',
        ],
        'id' => [
            'type' => 'bigint(20) unsigned',
            'primary' => true,
        ],
        'insert_time' => ['type' => 'bigint(20) unsigned'],
        'notes' => [
            'type' => "varchar($maxLengths[notes])",
            'characterSet' => 'utf8',
            'collation' => 'utf8_general_ci',
        ],
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
        'receiver_id_users' => ['type' => 'bigint(20) unsigned'],
        'sender_id_users' => ['type' => 'bigint(20) unsigned'],
        'sender_username' => \Username\column(),
        'tags' => [
            'type' => "varchar($maxLengths[tags])",
            'characterSet' => 'utf8',
            'collation' => 'utf8_unicode_ci',
        ],
        'timezone' => [
            'type' => 'int(11)',
            'nullable' => true,
        ],
        'username' => [
            'type' => "varchar($maxLengths[username])",
            'characterSet' => 'ascii',
            'collation' => 'ascii_bin',
        ],
    ]);

}
