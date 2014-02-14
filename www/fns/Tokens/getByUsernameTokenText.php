<?php

namespace Tokens;

function getByUsernameTokenText ($mysqli, $username, $tokentext) {
    $username = mysqli_real_escape_string($mysqli, $username);
    $tokentext = mysqli_real_escape_string($mysqli, $tokentext);
    $sql = 'select * from tokens'
        ." where username = '$username' and tokentext = '$tokentext'";
    include_once __DIR__.'/../mysqli_single_object.php';
    return mysqli_single_object($mysqli, $sql);
}
