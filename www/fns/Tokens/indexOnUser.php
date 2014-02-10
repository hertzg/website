<?php

namespace Tokens;

function indexOnUser ($mysqli, $idusers) {
    include_once __DIR__.'/../mysqli_query_object.php';
    return mysqli_query_object(
        $mysqli,
        'select * from tokens'
        ." where idusers = $idusers"
        .' order by tokentext'
    );
}
