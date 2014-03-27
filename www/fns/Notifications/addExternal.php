<?php

namespace Notifications;

function addExternal ($mysqli, $idusers, $idchannels, $channelname,
    $notificationtext, $id_subscribed_channels) {
    $channelname = $mysqli->real_escape_string($channelname);
    $notificationtext = $mysqli->real_escape_string($notificationtext);
    $insert_time = time();
    $sql = 'insert into notifications'
        .' (idusers, idchannels, channelname,'
        .' notificationtext, insert_time, id_subscribed_channels)'
        ." values ($idusers, $idchannels, '$channelname',"
        ." '$notificationtext', $insert_time, $id_subscribed_channels)";
    $mysqli->query($sql);
}
