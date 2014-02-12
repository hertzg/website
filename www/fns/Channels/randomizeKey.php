<?php

namespace Channels;

function randomizeKey ($mysqli, $idusers, $id) {
    $channelkey = mysqli_real_escape_string($mysqli, md5(uniqid(), true));
    $sql = "update channels set channelkey = '$channelkey'"
        ." where idusers = $idusers and idchannels = $id";
    mysqli_query($mysqli, $sql);
}
