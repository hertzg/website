<?php

namespace SendingContacts;

function ensure ($mysqli) {

    $fnsDir = __DIR__.'/..';

    include_once "$fnsDir/Contacts/maxLengths.php";
    $maxLengths = \Contacts\maxLengths();

    include_once "$fnsDir/Email/column.php";
    $emailColumn = \Email\column();

    include_once "$fnsDir/Username/column.php";
    $usernameColumn = \Username\column();

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

    include_once "$fnsDir/ApiKey/column.php";
    include_once "$fnsDir/ConnectionAddress/column.php";
    include_once "$fnsDir/FullName/column.php";
    include_once "$fnsDir/Table/ensure.php";
    include_once "$fnsDir/Tags/column.php";
    include_once "$fnsDir/UsernameAddress/column.php";
    return \Table\ensure($mysqli, 'sending_contacts', [
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
        'birthday_time' => [
            'type' => 'bigint(20)',
            'nullable' => true,
        ],
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
        'id_admin_connections' => ['type' => 'bigint(20) unsigned'],
        'id_users' => ['type' => 'bigint(20) unsigned'],
        'insert_time' => ['type' => 'bigint(20) unsigned'],
        'notes' => [
            'type' => "varchar($maxLengths[notes])",
            'characterSet' => 'utf8',
            'collation' => 'utf8_general_ci',
        ],
        'num_fails' => ['type' => 'bigint(20) unsigned'],
        'phone1' => $phone_column,
        'phone1_label' => $phone_label_column,
        'phone2' => $phone_column,
        'phone2_label' => $phone_label_column,
        'receiver_address' => \ConnectionAddress\column(),
        'receiver_username' => $usernameColumn,
        'sender_username' => $usernameColumn,
        'tags' => \Tags\column(),
        'their_exchange_api_key' => \ApiKey\column(),
        'timezone' => [
            'type' => 'int(11)',
            'nullable' => true,
        ],
        'username' => \UsernameAddress\column(),
    ]);

}
