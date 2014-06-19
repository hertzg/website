<?php

namespace Users\DeletedItems;

function purgeFolder ($mysqli, $deletedItem) {

    $id_deleted_items = $deletedItem->id;

    include_once __DIR__.'/../../DeletedFolders/deleteOnDeletedItem.php';
    \DeletedFolders\deleteOnDeletedItem($mysqli, $id_deleted_items);

    include_once __DIR__.'/../../DeletedFiles/deleteOnDeletedItem.php';
    \DeletedFiles\deleteOnDeletedItem($mysqli, $id_deleted_items);

}
