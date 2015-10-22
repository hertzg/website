<?php

namespace TokenAuths;

function indexOnToken ($mysqli, $id, $limit) {
    $sql = "select * from token_auths where id_tokens = $id"
        ." order by insert_time desc limit $limit";
    include_once __DIR__.'/../mysqli_query_object.php';
    return mysqli_query_object($mysqli, $sql);
}
