<?php

namespace Channels;

function getByName ($mysqli, $idusers, $channelname) {
    $channelname = $mysqli->real_escape_string($channelname);
    $sql = 'select * from channels'
        ." where idusers = $idusers and channelname = '$channelname'";
    include_once __DIR__.'/../mysqli_single_object.php';
    return mysqli_single_object($mysqli, $sql);
}
