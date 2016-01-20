<?php

namespace NoteRevisions;

function indexOnNote ($mysqli, $id_notes) {
    $sql = 'select * from note_revisions'
        ." where id_notes = $id_notes order by insert_time desc";
    include_once __DIR__.'/../mysqli_query_object.php';
    return mysqli_query_object($mysqli, $sql);
}
