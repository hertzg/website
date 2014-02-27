<?php

namespace Tokens;

function getByUsernameTokenText ($mysqli, $username, $tokentext) {
    $username = $mysqli->real_escape_string($username);
    $tokentext = $mysqli->real_escape_string($tokentext);
    $sql = 'select * from tokens'
        ." where username = '$username' and tokentext = '$tokentext'";
    include_once __DIR__.'/../mysqli_single_object.php';
    return mysqli_single_object($mysqli, $sql);
}
