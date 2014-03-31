<?php

namespace Channels;

function get ($mysqli, $id) {
    $sql = "select * from channels where id_channels = $id";
    include_once __DIR__.'/../mysqli_single_object.php';
    return mysqli_single_object($mysqli, $sql);
}
