<?php

namespace Users\DeletedItems;

function purgeNote ($mysqli, $deletedItem) {

    $data = json_decode($deletedItem->data_json);

    include_once __DIR__.'/../../NoteRevisions/deleteOnNote.php';
    \NoteRevisions\deleteOnNote($mysqli, $data->id);

}
