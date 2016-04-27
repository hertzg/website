<?php

namespace TaskTags;

function searchPageOnUserTagName ($mysqli, $id_users, $includes,
    $excludes, $tag_name, $offset, $limit, &$total, $order_by) {

    $fnsDir = __DIR__.'/..';
    $tag_name = $mysqli->real_escape_string($tag_name);

    include_once "$fnsDir/escape_like.php";
    $fromWhere = 'from task_tags'
        ." where id_users = $id_users and tag_name = '$tag_name'";
    foreach ($includes as $include) {
        $include = $mysqli->real_escape_string(escape_like($include));
        $fromWhere .= " and text like '%$include%'";
    }
    foreach ($excludes as $exclude) {
        $exclude = $mysqli->real_escape_string(escape_like($exclude));
        $fromWhere .= " and text not like '%$exclude%'";
    }

    $sql = "select count(*) total $fromWhere";
    include_once "$fnsDir/mysqli_single_object.php";
    $total = mysqli_single_object($mysqli, $sql)->total;

    if ($offset >= $total) return [];

    $sql = "select *, id_tasks id $fromWhere"
        ." order by top_priority desc, $order_by"
        ." limit $limit offset $offset";
    include_once "$fnsDir/mysqli_query_object.php";
    return mysqli_query_object($mysqli, $sql);

}
