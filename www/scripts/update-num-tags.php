#!/usr/bin/php
<?php

function update ($mysqli, $table) {
    $items = mysqli_query_object($mysqli, "select * from $table");
    foreach ($items as $item) {
        $num_tags = count(json_decode($item->tags_json));
        $sql = "update $table set num_tags = $num_tags where id = $item->id";
        $mysqli->query($sql) || trigger_error($mysqli->error);
    }
}

chdir(__DIR__);
include_once '../../lib/cli.php';
include_once '../../lib/defaults.php';
include_once '../fns/mysqli_query_object.php';
include_once '../fns/mysqli_single_object.php';
include_once '../lib/mysqli.php';

$microtime = microtime(true);

update($mysqli, 'bar_charts');
update($mysqli, 'bookmarks');
update($mysqli, 'calculations');
update($mysqli, 'contacts');
update($mysqli, 'notes');
update($mysqli, 'places');
update($mysqli, 'schedules');
update($mysqli, 'tasks');

$elapsedSeconds = number_format(microtime(true) - $microtime, 3);
echo "Done in $elapsedSeconds seconds.\n";
