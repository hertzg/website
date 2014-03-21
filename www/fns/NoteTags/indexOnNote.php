<?php

namespace NoteTags;

function indexOnNote ($mysqli, $idnotes) {
    $sql = 'select * from note_tags'
        ." where idnotes = $idnotes order by tagname";
    include_once __DIR__.'/../mysqli_query_object.php';
    return mysqli_query_object($mysqli, $sql);
}
