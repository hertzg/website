<?php

namespace Notifications;

function add ($mysqli, $idusers, $idchannels, $channelname, $notificationtext) {
    $channelname = $mysqli->real_escape_string($channelname);
    $notificationtext = $mysqli->real_escape_string($notificationtext);
    $insert_time = time();
    $sql = 'insert into notifications'
        .' (idusers, idchannels, channelname,'
        .' notificationtext, insert_time)'
        ." values ($idusers, $idchannels, '$channelname',"
        ." '$notificationtext', $insert_time)";
    $mysqli->query($sql);
}
