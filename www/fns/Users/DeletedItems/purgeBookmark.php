<?php

namespace Users\DeletedItems;

function purgeBookmark ($mysqli, $deletedItem) {

    $data = json_decode($deletedItem->data_json);

    include_once __DIR__.'/../../BookmarkRevisions/deleteOnBookmark.php';
    \BookmarkRevisions\deleteOnBookmark($mysqli, $data->id);

}
