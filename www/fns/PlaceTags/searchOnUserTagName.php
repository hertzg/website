<?php

namespace PlaceTags;

function searchOnUserTagName ($mysqli,
    $id_users, $includes, $excludes, $tag_name) {

    $fnsDir = __DIR__.'/..';
    $tag_name = $mysqli->real_escape_string($tag_name);

    include_once "$fnsDir/escape_like.php";
    $sql = 'select *, id_places id from place_tags'
        ." where id_users = $id_users and tag_name = '$tag_name'";
    foreach ($includes as $include) {
        $include = $mysqli->real_escape_string(escape_like($include));
        $sql .= " and name like '%$include%'";
    }
    foreach ($excludes as $exclude) {
        $exclude = $mysqli->real_escape_string(escape_like($exclude));
        $sql .= " and name like '%$exclude%'";
    }
    $sql .= ' order by update_time desc';

    include_once "$fnsDir/mysqli_query_object.php";
    return mysqli_query_object($mysqli, $sql);

}
