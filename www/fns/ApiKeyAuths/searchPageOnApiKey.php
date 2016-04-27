<?php

namespace ApiKeyAuths;

function searchPageOnApiKey ($mysqli, $id_api_keys,
    $includes, $excludes, $offset, $limit, &$total) {

    $fnsDir = __DIR__.'/..';

    include_once "$fnsDir/escape_like.php";
    $fromWhere = "from api_key_auths where id_api_keys = $id_api_keys";
    foreach ($includes as $include) {
        $include = $mysqli->real_escape_string(escape_like($include));
        $fromWhere .= " and (remote_address like '%$include%'"
            ." or method like '%$include%')";
    }
    foreach ($excludes as $exclude) {
        $exclude = $mysqli->real_escape_string(escape_like($exclude));
        $fromWhere .= " and remote_address not like '%$exclude%'"
            ." and method not like '%$exclude%'";
    }

    $sql = "select count(*) total $fromWhere";
    include_once "$fnsDir/mysqli_single_object.php";
    $total = mysqli_single_object($mysqli, $sql)->total;

    if ($offset >= $total) return [];

    $sql = "select * $fromWhere order by insert_time desc"
        ." limit $limit offset $offset";
    include_once "$fnsDir/mysqli_query_object.php";
    return mysqli_query_object($mysqli, $sql);

}
