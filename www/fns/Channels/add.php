<?php

namespace Channels;

function add ($mysqli, $idusers, $channelname) {
    $channelname = mysqli_real_escape_string($mysqli, $channelname);
    $channelkey = mysqli_real_escape_string($mysqli, md5(uniqid(), true));
    mysqli_query(
        $mysqli,
        'insert into channels (idusers, channelname, channelkey)'
        ." values ($idusers, '$channelname', '$channelkey')"
    );
    return mysqli_insert_id($mysqli);
}
