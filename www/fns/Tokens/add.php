<?php

namespace Tokens;

function add ($mysqli, $idusers, $username, $tokentext, $useragent) {
    $username = mysqli_real_escape_string($mysqli, $username);
    $tokentext = mysqli_real_escape_string($mysqli, $tokentext);
    $inserttime = $accesstime = time();
    if ($useragent === null) {
        $useragent = 'null';
    } else {
        $useragent = "'".mysqli_real_escape_string($mysqli, $useragent)."'";
    }
    mysqli_query(
        $mysqli,
        'insert into tokens (idusers, username, tokentext, useragent,'
        .' inserttime, accesstime)'
        ." values ($idusers, '$username', '$tokentext', $useragent,"
        ." $inserttime, $accesstime)"
    );
    return mysqli_insert_id($mysqli);
}
