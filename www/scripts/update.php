<?php

chdir(__DIR__);
include_once '../lib/mysqli.php';

$mysqli->query('alter table files change file_name name varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL');
$mysqli->query('alter table received_files change file_name name varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL');
$mysqli->query('alter table folders change folder_name name varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL');
