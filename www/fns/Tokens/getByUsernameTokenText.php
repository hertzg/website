<?php

namespace Tokens;

function getByUsernameTokenText ($mysqli, $username, $token_text) {
    $username = $mysqli->real_escape_string($username);
    $token_text = $mysqli->real_escape_string($token_text);
    $sql = 'select * from tokens'
        ." where username = '$username' and token_text = '$token_text'";
    include_once __DIR__.'/../mysqli_single_object.php';
    return mysqli_single_object($mysqli, $sql);
}
