<?php

namespace NoteTags;

function indexOnUser ($mysqli, $id_users) {
    $sql = 'select distinct tag_name from note_tags'
        ." where id_users = $id_users order by tag_name";
    include_once __DIR__.'/../mysqli_query_object.php';
    return mysqli_query_object($mysqli, $sql);
}
