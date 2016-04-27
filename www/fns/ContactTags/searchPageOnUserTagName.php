<?php

namespace ContactTags;

function searchPageOnUserTagName ($mysqli, $id_users, $includes,
    $excludes, $tag_name, $offset, $limit, &$total, $order_by) {

    $fnsDir = __DIR__.'/..';
    $tag_name = $mysqli->real_escape_string($tag_name);

    include_once "$fnsDir/escape_like.php";
    $fromWhere = 'from contact_tags'
        ." where id_users = $id_users and tag_name = '$tag_name'";
    foreach ($includes as $include) {
        $include = $mysqli->real_escape_string(escape_like($include));
        $fromWhere .= " and (full_name like '%$include%'"
            ." or alias like '%$include%'"
            ." or email1 like '%$include%'"
            ." or email2 like '%$include%'"
            ." or phone1 like '%$include%'"
            ." or phone2 like '%$include%')";
    }
    foreach ($excludes as $exclude) {
        $exclude = $mysqli->real_escape_string(escape_like($exclude));
        $fromWhere .= " and full_name not like '%$exclude%'"
            ." and alias not like '%$exclude%'"
            ." and email1 not like '%$exclude%'"
            ." and email2 not like '%$exclude%'"
            ." and phone1 not like '%$exclude%'"
            ." and phone2 not like '%$exclude%'";
    }

    $sql = "select count(*) total $fromWhere";
    include_once "$fnsDir/mysqli_single_object.php";
    $total = mysqli_single_object($mysqli, $sql)->total;

    if ($offset >= $total) return [];

    $sql = "select *, id_contacts id $fromWhere"
        ." order by favorite desc, $order_by limit $limit offset $offset";
    include_once "$fnsDir/mysqli_query_object.php";
    return mysqli_query_object($mysqli, $sql);

}
