<?php

namespace Users\DeletedItems;

function purgeTask ($mysqli, $deletedItem) {

    $data = json_decode($deletedItem->data_json);

    include_once __DIR__.'/../../TaskRevisions/deleteOnTask.php';
    \TaskRevisions\deleteOnTask($mysqli, $data->id);

}
