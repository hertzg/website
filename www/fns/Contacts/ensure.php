<?php

namespace Contacts;

function ensure ($mysqli) {

    include_once __DIR__.'/maxLengths.php';
    $maxLengths = maxLengths();

    include_once __DIR__.'/../Table/ensure.php';
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
        'birthday_day' => [
            'type' => 'bigint(20) unsigned',
            'nullable' => true,
        ],
        'birthday_month' => [
            'type' => 'bigint(20) unsigned',
            'nullable' => true,
        ],
        'birthday_time' => [
            'type' => 'bigint(20)',
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
        'id_users' => [
            'type' => 'bigint(20) unsigned',
        ],
        'insert_api_key_id' => [
            'type' => 'bigint(20) unsigned',
            'nullable' => true,
        ],
        'insert_api_key_name' => [
            'type' => "varchar($maxLengths[insert_api_key_name])",
            'nullable' => true,
            'characterSet' => 'utf8',
            'collation' => 'utf8_general_ci',
        ],
        'insert_time' => [
            'type' => 'bigint(20) unsigned',
        ],
        'notes' => [
            'type' => "varchar($maxLengths[notes])",
            'characterSet' => 'utf8',
            'collation' => 'utf8_general_ci',
        ],
        'num_tags' => [
            'type' => 'tinyint(3) unsigned',
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
        'revision' => [
            'type' => 'bigint(20) unsigned',
        ],
        'tags' => [
            'type' => "varchar($maxLengths[tags])",
            'characterSet' => 'utf8',
            'collation' => 'utf8_unicode_ci',
        ],
        'tags_json' => [
            'type' => "varchar($maxLengths[tags_json])",
            'characterSet' => 'ascii',
            'collation' => 'ascii_bin',
        ],
        'timezone' => [
            'type' => 'int(11)',
            'nullable' => true,
        ],
        'update_api_key_id' => [
            'type' => 'bigint(20) unsigned',
            'nullable' => true,
        ],
        'update_api_key_name' => [
            'type' => "varchar($maxLengths[update_api_key_name])",
            'nullable' => true,
            'characterSet' => 'utf8',
            'collation' => 'utf8_general_ci',
        ],
        'update_time' => [
            'type' => 'bigint(20) unsigned',
        ],
        'username' => [
            'type' => "varchar($maxLengths[username])",
            'characterSet' => 'ascii',
            'collation' => 'ascii_bin',
        ],
    ]);

}