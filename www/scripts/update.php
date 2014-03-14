<?php

include_once '../lib/mysqli.php';

$mysqli->query('alter table users add show_bookmarks tinyint unsigned default 1 not null');
$mysqli->query('alter table users add show_calendar tinyint unsigned default 1 not null');
$mysqli->query('alter table users add show_contacts tinyint unsigned default 1 not null');
$mysqli->query('alter table users add show_files tinyint unsigned default 1 not null');
$mysqli->query('alter table users add show_notes tinyint unsigned default 1 not null');
$mysqli->query('alter table users add show_notifications tinyint unsigned default 1 not null');
$mysqli->query('alter table users add show_tasks tinyint unsigned default 1 not null');

echo 'Done';
