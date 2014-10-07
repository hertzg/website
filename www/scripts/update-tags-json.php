#!/usr/bin/php
<?php

function process ($mysqli, $table) {
    $id_column = "id_$table";
    $rows = mysqli_query_object($mysqli, "select * from $table");
    foreach ($rows as $row) {
        $tag_names = Tags\parse($row->tags);
        $tags_json = $mysqli->real_escape_string(json_encode($tag_names));
        $id = $row->$id_column;
        $sql = "update $table set tags_json = '$tags_json'"
            ." where $id_column = $id";
        $mysqli->query($sql) || trigger_error($mysqli->error);
    }
}

chdir(__DIR__);
include_once '../../lib/cli.php';
include_once '../fns/mysqli_query_object.php';
include_once '../fns/mysqli_single_object.php';
include_once '../fns/Tags/parse.php';
include_once '../lib/mysqli.php';

$microtime = microtime(true);

process($mysqli, 'bookmarks');
process($mysqli, 'contacts');
process($mysqli, 'notes');
process($mysqli, 'tasks');

$elapsedSeconds = number_format(microtime(true) - $microtime, 3);
echo "Done in $elapsedSeconds seconds.\n";
