<?php

namespace Tokens;

function updateAccessTime ($mysqli, $id) {
    $accesstime = time();
    mysqli_query(
        $mysqli,
        'update tokens set'
        ." accesstime = $accesstime"
        ." where idtokens = $id"
    );
}
