<?php

namespace Tokens;

function indexOnUser ($mysqli, $id_users) {
    include_once __DIR__.'/../mysqli_query_object.php';
    return mysqli_query_object(
        $mysqli,
        'select * from tokens'
        ." where id_users = $id_users"
        .' order by token_text'
    );
}
