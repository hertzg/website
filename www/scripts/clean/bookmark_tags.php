#!/usr/bin/php
<?php

chdir(__DIR__);
include_once '../../lib/mysqli.php';

$microtime = microtime(true);

$sql = 'delete from bookmark_tags where id_users'
    .' not in (select id_users from users)';
$mysqli->query($sql) || trigger_error($mysqli->error);
$deleted = $mysqli->affected_rows;

$sql = 'delete from bookmark_tags where id_bookmarks not in'
    .' (select id_bookmarks from bookmarks'
    .' where bookmarks.id_users = bookmark_tags.id_users)';
$mysqli->query($sql) || trigger_error($mysqli->error);
$deleted += $mysqli->affected_rows;

$elapsedSeconds = number_format(microtime(true) - $microtime, 3);
echo "Done in $elapsedSeconds seconds.\n"
    ." $deleted row(s) deleted.\n";
