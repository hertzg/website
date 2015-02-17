<?php

chdir(__DIR__);
include_once '../../lib/cli.php';
include_once '../fns/mysqli_query_object.php';
include_once '../lib/mysqli.php';

$microtime = microtime(true);

$mysqli->query('delete from place_points') || trigger_error($mysqli->error);

$sql = 'update places set num_points = 1';
$mysqli->query($sql) || trigger_error($mysqli->error);

include_once '../fns/PlacePoints/add.php';
$places = mysqli_query_object($mysqli, 'select * from places');
foreach ($places as $place) {
    PlacePoints\add($mysqli, $place->id_users, $place->id,
        $place->latitude, $place->longitude, $place->altitude);
}

$elapsedSeconds = number_format(microtime(true) - $microtime, 3);
echo "Done in $elapsedSeconds seconds.\n";
