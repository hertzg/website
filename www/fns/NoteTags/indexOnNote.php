<?php

namespace NoteTags;

function indexOnNote ($mysqli, $id_notes) {
    $sql = 'select * from note_tags'
        ." where id_notes = $id_notes order by tag_name";
    include_once __DIR__.'/../mysqli_query_object.php';
    return mysqli_query_object($mysqli, $sql);
}
