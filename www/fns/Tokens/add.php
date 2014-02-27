<?php

namespace Tokens;

function add ($mysqli, $idusers, $username, $tokentext, $useragent) {
    $username = $mysqli->real_escape_string($username);
    $tokentext = $mysqli->real_escape_string($tokentext);
    $inserttime = $accesstime = time();
    if ($useragent === null) {
        $useragent = 'null';
    } else {
        $useragent = "'".$mysqli->real_escape_string($useragent)."'";
    }
    $sql = 'insert into tokens (idusers, username, tokentext, useragent,'
        .' inserttime, accesstime)'
        ." values ($idusers, '$username', '$tokentext', $useragent,"
        ." $inserttime, $accesstime)";
    $mysqli->query($sql);
    return $mysqli->insert_id;
}
