<?php

namespace Tokens;

function add ($mysqli, $idusers, $username, $tokentext, $useragent) {
    $username = $mysqli->real_escape_string($username);
    $tokentext = $mysqli->real_escape_string($tokentext);
    $insert_time = $access_time = time();
    if ($useragent === null) {
        $useragent = 'null';
    } else {
        $useragent = "'".$mysqli->real_escape_string($useragent)."'";
    }
    $sql = 'insert into tokens (idusers, username, tokentext, useragent,'
        .' insert_time, access_time)'
        ." values ($idusers, '$username', '$tokentext', $useragent,"
        ." $insert_time, $access_time)";
    $mysqli->query($sql);
    return $mysqli->insert_id;
}
