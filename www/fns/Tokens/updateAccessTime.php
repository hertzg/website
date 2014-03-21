<?php

namespace Tokens;

function updateaccess_time ($mysqli, $id) {
    $access_time = time();
    $sql = 'update tokens set'
        ." access_time = $access_time"
        ." where idtokens = $id";
    $mysqli->query($sql);
}
