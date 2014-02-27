<?php

namespace Notifications;

function add ($mysqli, $idusers, $idchannels, $channelname, $notificationtext) {
    $channelname = $mysqli->real_escape_string($channelname);
    $notificationtext = $mysqli->real_escape_string($notificationtext);
    $inserttime = time();
    $sql = 'insert into notifications'
        .' (idusers, idchannels, channelname,'
        .' notificationtext, inserttime)'
        ." values ($idusers, $idchannels, '$channelname',"
        ." '$notificationtext', $inserttime)";
    $mysqli->query($sql);
}
