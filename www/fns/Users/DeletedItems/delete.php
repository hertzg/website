<?php

namespace Users\DeletedItems;

function delete ($mysqli, $deletedItem) {
    include_once __DIR__.'/../../DeletedItems/delete.php';
    \DeletedItems\delete($mysqli, $deletedItem->id);
}
