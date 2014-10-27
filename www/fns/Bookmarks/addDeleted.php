<?php

namespace Bookmarks;

function addDeleted ($mysqli, $id, $id_users,
    $url, $title, $tags, $tag_names, $insert_time, $update_time) {

    $url = $mysqli->real_escape_string($url);
    $title = $mysqli->real_escape_string($title);
    $tags = $mysqli->real_escape_string($tags);
    $num_tags = count($tag_names);
    $tags_json = $mysqli->real_escape_string(json_encode($tag_names));

    $sql = 'insert into bookmarks'
        .' (id, id_users, url, title, tags,'
        .' num_tags, tags_json, insert_time, update_time)'
        ." values ($id, $id_users, '$url', '$title', '$tags',"
        ." $num_tags, '$tags_json', $insert_time, $update_time)";

    $mysqli->query($sql) || trigger_error($mysqli->error);

}
