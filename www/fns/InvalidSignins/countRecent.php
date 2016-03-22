<?php

namespace InvalidSignins;

function countRecent ($mysqli, $remote_address) {

    $remote_address = $mysqli->real_escape_string($remote_address);
    $insert_time = time() - 60;

    $sql = 'select count(*) total from invalid_signins'
        ." where remote_address = '$remote_address'"
        ." and insert_time > $insert_time";

    include_once __DIR__.'/../mysqli_single_object.php';
    return mysqli_single_object($mysqli, $sql)->total;

}
