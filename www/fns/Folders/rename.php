<?php

namespace Folders;

function rename ($mysqli, $id, $name, $renameApiKey) {

    $name = $mysqli->real_escape_string($name);
    $rename_time = time();
    if ($renameApiKey === null) {
        $rename_api_key_id = $rename_api_key_name = 'null';
    } else {

        $rename_api_key_id = $renameApiKey->id;

        $keyName = $renameApiKey->name;
        $rename_api_key_name = "'".$mysqli->real_escape_string($keyName)."'";

    }

    $sql = "update folders set name = '$name', rename_time = $rename_time,"
        ." rename_api_key_id = $rename_api_key_id,"
        ." rename_api_key_name = $rename_api_key_name,"
        ." revision = revision + 1 where id_folders = $id";

    $mysqli->query($sql) || trigger_error($mysqli->error);

}
