#!/usr/bin/php
<?php

chdir(__DIR__);
include_once '../../lib/cli.php';
include_once '../../lib/defaults.php';
include_once '../fns/mysqli_query_object.php';
include_once '../lib/mysqli.php';

$microtime = microtime(true);

$sql = 'select * from contacts where birthday_time is not null';
$contacts = mysqli_query_object($mysqli, $sql);
foreach ($contacts as $contact) {
    $birthday_time = $contact->birthday_time;
    $birthday_day = date('j', $birthday_time);
    $birthday_month = date('n', $birthday_time);
    $birthday_year = date('Y', $birthday_time);
    $sql = "update contacts set birthday_day = $birthday_day,"
        ." birthday_month = $birthday_month, birthday_year = $birthday_year"
        ." where id = $contact->id";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}

$elapsedSeconds = number_format(microtime(true) - $microtime, 3);
echo "Done in $elapsedSeconds seconds.\n";
