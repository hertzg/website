<?php

namespace Channels;

function getByNameKey ($mysqli, $channelname, $channelkey) {
    $channelname = $mysqli->real_escape_string($channelname);
    $channelkey = $mysqli->real_escape_string($channelkey);
    $sql = 'select * from channels'
        ." where channelname = '$channelname'"
        ." and channelkey = '$channelkey'";
    include_once __DIR__.'/../mysqli_single_object.php';
    return mysqli_single_object($mysqli, $sql);
}
