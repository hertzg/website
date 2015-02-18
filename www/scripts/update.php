<?php

chdir(__DIR__);
include_once '../../lib/cli.php';
include_once '../fns/mysqli_query_object.php';
include_once '../lib/mysqli.php';

$microtime = microtime(true);

include_once '../fns/PlacePoints/add.php';
$places = mysqli_query_object($mysqli, 'select * from places where num_points = 0');
foreach ($places as $place) {

    $id = $place->id;

    PlacePoints\add($mysqli, $place->id_users, $id,
        $place->latitude, $place->longitude, $place->altitude);

    $sql = "update places set num_points = 1 where id = $id";
    $mysqli->query($sql) || trigger_error($mysqli->error);

}

$elapsedSeconds = number_format(microtime(true) - $microtime, 3);
echo "Done in $elapsedSeconds seconds.\n";
