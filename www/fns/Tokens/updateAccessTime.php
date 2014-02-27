<?php

namespace Tokens;

function updateAccessTime ($mysqli, $id) {
    $accesstime = time();
    $sql = 'update tokens set'
        ." accesstime = $accesstime"
        ." where idtokens = $id";
    $mysqli->query($sql);
}
