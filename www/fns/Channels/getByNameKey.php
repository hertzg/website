<?php

namespace Channels;

function getByNameKey ($mysqli, $channelname, $channelkey) {
    $channelname = mysqli_real_escape_string($mysqli, $channelname);
    $channelkey = mysqli_real_escape_string($mysqli, $channelkey);
    $sql = 'select * from channels'
        ." where channelname = '$channelname'"
        ." and channelkey = '$channelkey'";
    include_once __DIR__.'/../mysqli_single_object.php';
    return mysqli_single_object($mysqli, $sql);
}
