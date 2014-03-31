<?php

chdir(__DIR__);
include_once '../lib/mysqli.php';

$mysqli->query('alter table notes change note_text text varchar(1024) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL');
$mysqli->query('alter table note_tags change note_text text varchar(1024) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL');
