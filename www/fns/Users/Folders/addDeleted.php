<?php

namespace Users\Folders;

function addDeleted ($mysqli, $id_users, $data) {
    include_once __DIR__.'/../../Folders/addDeleted.php';
    \Folders\addDeleted($mysqli, $data->id, $id_users,
        $data->parent_id_folders, $data->name,
        $data->insert_time, $data->rename_time);
}
