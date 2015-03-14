<?php

namespace PlaceTags;

function indexOnUserTagName ($mysqli, $id_users, $tag_name) {
    $tag_name = $mysqli->real_escape_string($tag_name);
    $sql = "select *, id_places id from place_tags where id_users = $id_users"
        ." and tag_name = '$tag_name' order by update_time";
    include_once __DIR__.'/../mysqli_query_object.php';
    return mysqli_query_object($mysqli, $sql);
}
