#!/usr/bin/php
<?php

function update ($mysqli, $table) {
    $id_column = "id_$table";
    $items = mysqli_query_object($mysqli, "select * from $table");
    foreach ($items as $item) {
        $num_tags = count(json_decode($item->tags_json));
        $sql = "update $table set num_tags = $num_tags"
            ." where $id_column = {$item->$id_column}";
        $mysqli->query($sql) || trigger_error($mysqli->error);
    }
}

$microtime = microtime(true);

chdir(__DIR__);
include_once '../../lib/cli.php';
include_once '../fns/mysqli_query_object.php';
include_once '../fns/mysqli_single_object.php';
include_once '../lib/mysqli.php';

update($mysqli, 'bookmarks');
update($mysqli, 'contacts');
update($mysqli, 'notes');
update($mysqli, 'tasks');

$elapsedSeconds = number_format(microtime(true) - $microtime, 3);
echo "Done in $elapsedSeconds seconds.\n";
