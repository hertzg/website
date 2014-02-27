<?php

namespace Channels;

function add ($mysqli, $idusers, $channelname) {
    $channelname = $mysqli->real_escape_string($channelname);
    $channelkey = $mysqli->real_escape_string(md5(uniqid(), true));
    $sql = 'insert into channels (idusers, channelname, channelkey)'
        ." values ($idusers, '$channelname', '$channelkey')";
    $mysqli->query($sql);
    return $mysqli->insert_id;
}
