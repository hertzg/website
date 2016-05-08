<?php

namespace ContactTags;

function ensure ($mysqli) {

    $fnsDir = __DIR__.'/..';

    include_once "$fnsDir/Contacts/maxLengths.php";
    $maxLengths = \Contacts\maxLengths();

    include_once "$fnsDir/Email/column.php";
    $emailColumn = \Email\column();

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

    include_once "$fnsDir/FullName/column.php";
    include_once "$fnsDir/Table/ensure.php";
    include_once "$fnsDir/TagName/column.php";
    return \Table\ensure($mysqli, 'contact_tags', [
        'alias' => [
            'type' => "varchar($maxLengths[alias])",
            'characterSet' => 'utf8',
            'collation' => 'utf8_unicode_ci',
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
        'id_contacts' => ['type' => 'bigint(20) unsigned'],
        'id_users' => ['type' => 'bigint(20) unsigned'],
        'insert_time' => ['type' => 'bigint(20) unsigned'],
        'phone1' => $phone_column,
        'phone1_label' => $phone_label_column,
        'phone2' => $phone_column,
        'phone2_label' => $phone_label_column,
        'photo_id' => [
            'type' => 'bigint(20) unsigned',
            'nullable' => true,
        ],
        'tag_name' => \TagName\column(),
        'update_time' => ['type' => 'bigint(20) unsigned'],
    ]);

}
