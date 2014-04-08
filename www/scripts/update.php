<?php

chdir(__DIR__);
include_once '../lib/mysqli.php';

$mysqli->query('alter table notes change text text text character set utf8 collate utf8_unicode_ci not null') || trigger_error($mysqli->error);
$mysqli->query('alter table note_tags change text text text character set utf8 collate utf8_unicode_ci not null') || trigger_error($mysqli->error);
