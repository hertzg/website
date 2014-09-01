#!/usr/bin/php
<?php

include_once 'fns/ensure_table.php';
ensure_table('feedbacks', [
    'idfeedbacks' => [
        'type' => 'bigint(20) unsigned',
        'primary' => true,
    ],
    'id_users' => [
        'type' => 'bigint(20) unsigned',
        'nullable' => true,
    ],
    'insert_time' => [
        'type' => 'bigint(20) unsigned',
    ],
    'text' => [
        'type' => 'text',
        'characterSet' => 'utf8',
        'collation' => 'utf8_unicode_ci',
    ],
]);
