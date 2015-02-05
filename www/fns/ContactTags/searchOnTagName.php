<?php

namespace ContactTags;

function searchOnTagName ($mysqli, $id_users,
    $keyword, $tag_name, $offset, $limit, &$total) {

    $fnsDir = __DIR__.'/..';

    include_once "$fnsDir/escape_like.php";
    $keyword = escape_like($keyword);
    $keyword = $mysqli->real_escape_string($keyword);
    $tag_name = $mysqli->real_escape_string($tag_name);

    $fromWhere = "from contact_tags where id_users = $id_users"
        ." and (full_name like '%$keyword%' or alias like '%$keyword%'"
        ." or email like '%$keyword%' or phone1 like '%$keyword%'"
        ." or phone2 like '%$keyword%') and tag_name = '$tag_name'";

    $sql = "select count(*) total $fromWhere";
    include_once "$fnsDir/mysqli_single_object.php";
    $total = mysqli_single_object($mysqli, $sql)->total;

    if ($offset >= $total) return [];

    $sql = "select *, id_contacts id $fromWhere"
        ." order by favorite desc, full_name limit $limit offset $offset";
    include_once "$fnsDir/mysqli_query_object.php";
    return mysqli_query_object($mysqli, $sql);

}
