#!/usr/bin/php
<?php

chdir(__DIR__);
include_once '../../../lib/mysqli.php';

$microtime = microtime(true);

// TODO fix this, the item may be in trash
$sql = 'delete from received_folder_files'
    .' where id_received_folders not in (select id from received_folders)'
    .' or id_users not in (select id_users from users)'
    .' or (parent_id != 0 and parent_id not in (select id from received_folder_subfolders))';
$mysqli->query($sql) || trigger_error($mysqli->error);

$elapsedSeconds = number_format(microtime(true) - $microtime, 3);
echo "Done in $elapsedSeconds seconds.\n"
    ." $mysqli->affected_rows row(s) deleted.\n";
