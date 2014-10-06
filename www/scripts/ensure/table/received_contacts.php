#!/usr/bin/php
<?php

chdir(__DIR__);
include_once '../../../../lib/cli.php';

include_once '../../../fns/Contacts/maxLengths.php';
$maxLengths = Contacts\maxLengths();

include_once 'fns/ensure_table.php';
include_once '../../../fns/Username/maxLength.php';
ensure_table('received_contacts', [
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
    'archived' => [
        'type' => 'tinyint(3) unsigned',
    ],
    'birthday_time' => [
        'type' => 'bigint(20) unsigned',
        'nullable' => true,
    ],
    'email' => [
        'type' => "varchar($maxLengths[email])",
        'characterSet' => 'utf8',
        'collation' => 'utf8_general_ci',
    ],
    'favorite' => [
        'type' => 'tinyint(3) unsigned',
    ],
    'full_name' => [
        'type' => "varchar($maxLengths[full_name])",
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
    'receiver_id_users' => [
        'type' => 'bigint(20) unsigned',
    ],
    'sender_id_users' => [
        'type' => 'bigint(20) unsigned',
    ],
    'sender_username' => [
        'type' => 'varchar('.Username\maxLength().')',
        'characterSet' => 'ascii',
        'collation' => 'ascii_bin',
    ],
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
