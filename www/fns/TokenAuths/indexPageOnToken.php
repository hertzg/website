<?php

namespace TokenAuths;

function indexPageOnToken ($mysqli, $id_tokens, $offset, $limit, &$total) {

    $fnsDir = __DIR__.'/..';

    $fromWhere = "from token_auths where id_tokens = $id_tokens";

    $sql = "select count(*) total $fromWhere";
    include_once "$fnsDir/mysqli_single_object.php";
    $total = mysqli_single_object($mysqli, $sql)->total;

    if ($offset >= $total) return [];

    $sql = "select * $fromWhere order by insert_time desc"
        ." limit $limit offset $offset";
    include_once "$fnsDir/mysqli_query_object.php";
    return mysqli_query_object($mysqli, $sql);

}
