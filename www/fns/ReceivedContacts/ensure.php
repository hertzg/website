<?php

namespace ReceivedContacts;

function ensure ($mysqli) {

    $fnsDir = __DIR__.'/..';

    include_once "$fnsDir/Contacts/maxLengths.php";
    $maxLengths = \Contacts\maxLengths();

    include_once "$fnsDir/Email/column.php";
    $emailColumn = \Email\column();

    $nullable_unsigned_bigint = [
        'type' => 'bigint(20) unsigned',
        'nullable' => true,
    ];
    $email_label_column = [
        'type' => "varchar($maxLengths[email_label])",
        'characterSet' => 'utf8',
        'collation' => 'utf8_general_ci',
    ];
    $phone_column = [
        'type' => "varchar($maxLengths[phone])",
        'characterSet' => 'utf8',
        'collation' => 'utf8_general_ci',
    ];
    $phone_label_column = [
        'type' => "varchar($maxLengths[phone_label])",
        'characterSet' => 'utf8',
        'collation' => 'utf8_general_ci',
    ];

    include_once "$fnsDir/ConnectionAddress/column.php";
    include_once "$fnsDir/FullName/column.php";
    include_once "$fnsDir/Table/ensure.php";
    include_once "$fnsDir/Tags/column.php";
    include_once "$fnsDir/Username/column.php";
    include_once "$fnsDir/UsernameAddress/column.php";
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
        'birthday_time' => $nullable_unsigned_bigint,
        'email1' => $emailColumn,
        'email1_label' => $email_label_column,
        'email2' => $emailColumn,
        'email2_label' => $email_label_column,
        'favorite' => ['type' => 'tinyint(3) unsigned'],
        'full_name' => \FullName\column(),
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
        'phone1' => $phone_column,
        'phone1_label' => $phone_label_column,
        'phone2' => $phone_column,
        'phone2_label' => $phone_label_column,
        'photo_id' => $nullable_unsigned_bigint,
        'receiver_id_users' => ['type' => 'bigint(20) unsigned'],
        'sender_address' => \ConnectionAddress\column(true),
        'sender_id_users' => $nullable_unsigned_bigint,
        'sender_username' => \Username\column(),
        'tags' => \Tags\column(),
        'timezone' => [
            'type' => 'int(11)',
            'nullable' => true,
        ],
        'username' => \UsernameAddress\column(),
    ]);

}
