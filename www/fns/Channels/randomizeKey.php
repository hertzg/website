<?php

namespace Channels;

function randomizeKey ($mysqli, $idusers, $id) {
    $channelkey = $mysqli->real_escape_string(md5(uniqid(), true));
    $sql = "update channels set channelkey = '$channelkey'"
        ." where idusers = $idusers and idchannels = $id";
    $mysqli->query($sql);
}
