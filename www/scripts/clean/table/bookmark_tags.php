#!/usr/bin/php
<?php

chdir(__DIR__);
include_once '../../lib/require-cli.php';
include_once '../../../lib/mysqli.php';

$microtime = microtime(true);

$sql = 'delete from bookmark_tags'
    .' where id_users not in (select id_users from users)'
    .' or id_bookmarks not in (select id_bookmarks from bookmarks)';
$mysqli->query($sql) || trigger_error($mysqli->error);

$elapsedSeconds = number_format(microtime(true) - $microtime, 3);
echo "Done in $elapsedSeconds seconds.\n"
    ." $mysqli->affected_rows row(s) deleted.\n";
