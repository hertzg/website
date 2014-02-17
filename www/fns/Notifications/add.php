<?php

namespace Notifications;

function add ($mysqli, $idusers, $idchannels, $channelname, $notificationtext) {
    $channelname = mysqli_real_escape_string($mysqli, $channelname);
    $notificationtext = mysqli_real_escape_string($mysqli, $notificationtext);
    $inserttime = time();
    mysqli_query(
        $mysqli,
        'insert into notifications'
        .' (idusers, idchannels, channelname,'
        .' notificationtext, inserttime)'
        ." values ($idusers, $idchannels, '$channelname',"
        ." '$notificationtext', $inserttime)"
    );
}
