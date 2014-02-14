<?php

namespace Tokens;

function get ($mysqli, $id) {
    $sql = "select * from tokens where idtokens = $id";
    include_once __DIR__.'/../mysqli_single_object.php';
    return mysqli_single_object($mysqli, $sql);
}
