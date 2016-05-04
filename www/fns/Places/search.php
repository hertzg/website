<?php

namespace Places;

function search ($mysqli, $id_users, $includes, $excludes) {

    $fnsDir = __DIR__.'/..';

    include_once "$fnsDir/escape_like.php";
    $sql = "select * from places where id_users = $id_users";
    foreach ($includes as $include) {
        $include = $mysqli->real_escape_string(escape_like($include));
        $sql .= " and name like '%$include%'";
    }
    foreach ($excludes as $exclude) {
        $exclude = $mysqli->real_escape_string(escape_like($exclude));
        $sql .= " and name not like '%$exclude%'";
    }
    $sql .= ' order by update_time desc';

    include_once "$fnsDir/mysqli_query_object.php";
    return mysqli_query_object($mysqli, $sql);

}
