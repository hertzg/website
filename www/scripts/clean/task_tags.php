#!/usr/bin/php
<?php

chdir(__DIR__);
include_once '../../lib/mysqli.php';

$microtime = microtime(true);

$sql = 'delete from task_tags where id_users'
    .' not in (select id_users from users)';
$mysqli->query($sql) || trigger_error($mysqli->error);
$deleted = $mysqli->affected_rows;

$sql = 'delete from task_tags where id_tasks not in'
    .' (select id_tasks from tasks'
    .' where tasks.id_users = task_tags.id_users)';
$mysqli->query($sql) || trigger_error($mysqli->error);
$deleted += $mysqli->affected_rows;

$elapsedSeconds = number_format(microtime(true) - $microtime, 3);
echo "Done in $elapsedSeconds seconds.\n"
    ." $deleted row(s) deleted.\n";
