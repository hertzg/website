<?php

namespace Folders;

function searchInFolder ($mysqli,
    $id_users, $parent_id, $includes, $excludes) {

    $fnsDir = __DIR__.'/..';

    include_once "$fnsDir/escape_like.php";
    $sql = 'select * from folders'
        ." where id_users = $id_users and parent_id = $parent_id";
    foreach ($includes as $include) {
        $include = $mysqli->real_escape_string(escape_like($include));
        $sql .= " and name like '%$include%'";
    }
    foreach ($excludes as $exclude) {
        $exclude = $mysqli->real_escape_string(escape_like($exclude));
        $sql .= " and name not like '%$exclude%'";
    }
    $sql .= ' order by name';

    include_once "$fnsDir/mysqli_query_object.php";
    return mysqli_query_object($mysqli, $sql);

}
