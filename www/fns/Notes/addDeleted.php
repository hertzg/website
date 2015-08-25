<?php

namespace Notes;

function addDeleted ($mysqli, $id, $id_users, $text, $title, $tags,
    $tag_names, $encrypt_in_listings, $insert_time, $update_time, $revision) {

    $text = $mysqli->real_escape_string($text);
    $title = $mysqli->real_escape_string($title);
    $tags = $mysqli->real_escape_string($tags);
    $num_tags = count($tag_names);
    $tags_json = $mysqli->real_escape_string(json_encode($tag_names));
    $encrypt_in_listings = $encrypt_in_listings ? '1' : '0';

    $sql = 'insert into notes'
        .' (id, id_users, text, title, tags,'
        .' num_tags, tags_json, encrypt_in_listings,'
        .' insert_time, update_time, revision)'
        ." values ($id, $id_users, '$text', '$title', '$tags',"
        ." $num_tags, '$tags_json', $encrypt_in_listings,"
        ." $insert_time, $update_time, $revision)";

    $mysqli->query($sql) || trigger_error($mysqli->error);

}
