<?php

namespace DeletedFolders;

function deleteOnDeletedItem ($mysqli, $id_deleted_items) {
    $sql = 'delete from deleted_folders'
        ." where id_deleted_items = $id_deleted_items";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
