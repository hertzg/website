<?php

namespace Files;

function searchInFolder ($mysqli,
    $id_users, $id_folders, $includes, $excludes) {

    $fnsDir = __DIR__.'/..';

    include_once "$fnsDir/escape_like.php";
    $sql = 'select * from files'
        ." where id_users = $id_users and id_folders = $id_folders";
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
