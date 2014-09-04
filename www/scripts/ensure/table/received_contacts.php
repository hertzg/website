#!/usr/bin/php
<?php

include_once 'fns/ensure_table.php';
ensure_table('received_contacts', [
    'address' => [
        'type' => 'varchar(128)',
        'characterSet' => 'utf8',
        'collation' => 'utf8_general_ci',
    ],
    'alias' => [
        'type' => 'varchar(32)',
        'characterSet' => 'utf8',
        'collation' => 'utf8_unicode_ci',
    ],
    'archived' => [
        'type' => 'tinyint(3) unsigned',
    ],
    'birthday_time' => [
        'type' => 'bigint(20) unsigned',
        'nullable' => true,
    ],
    'email' => [
        'type' => 'varchar(64)',
        'characterSet' => 'utf8',
        'collation' => 'utf8_general_ci',
    ],
    'favorite' => [
        'type' => 'tinyint(3) unsigned',
    ],
    'full_name' => [
        'type' => 'varchar(32)',
        'characterSet' => 'utf8',
        'collation' => 'utf8_unicode_ci',
    ],
    'id' => [
        'type' => 'bigint(20) unsigned',
        'primary' => true,
    ],
    'insert_time' => [
        'type' => 'bigint(20) unsigned',
    ],
    'phone1' => [
        'type' => 'varchar(32)',
        'characterSet' => 'utf8',
        'collation' => 'utf8_general_ci',
    ],
    'phone2' => [
        'type' => 'varchar(32)',
        'characterSet' => 'utf8',
        'collation' => 'utf8_general_ci',
    ],
    'receiver_id_users' => [
        'type' => 'bigint(20) unsigned',
    ],
    'sender_id_users' => [
        'type' => 'bigint(20) unsigned',
    ],
    'sender_username' => [
        'type' => 'varchar(32)',
        'characterSet' => 'ascii',
        'collation' => 'ascii_bin',
    ],
    'tags' => [
        'type' => 'varchar(256)',
        'characterSet' => 'utf8',
        'collation' => 'utf8_unicode_ci',
    ],
    'timezone' => [
        'type' => 'int(11)',
        'nullable' => true,
    ],
    'username' => [
        'type' => 'varchar(32)',
        'characterSet' => 'ascii',
        'collation' => 'ascii_bin',
    ],
]);
