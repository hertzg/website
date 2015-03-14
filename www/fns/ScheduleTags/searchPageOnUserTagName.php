<?php

namespace ScheduleTags;

function searchPageOnUserTagName ($mysqli, $id_users, $keyword, $tag_name) {

    $fnsDir = __DIR__.'/..';

    include_once "$fnsDir/escape_like.php";
    $keyword = escape_like($keyword);
    $keyword = $mysqli->real_escape_string($keyword);
    $tag_name = $mysqli->real_escape_string($tag_name);

    $sql = "select *, id_schedules id from schedule_tags"
        ." where id_users = $id_users and text like '%$keyword%'"
        ." and tag_name = '$tag_name' order by update_time desc";
    include_once "$fnsDir/mysqli_query_object.php";
    return mysqli_query_object($mysqli, $sql);

}
