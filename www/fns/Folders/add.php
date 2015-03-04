<?php

namespace Folders;

function add ($mysqli, $id_users, $parent_id, $name, $insertApiKey) {

    $name = $mysqli->real_escape_string($name);
    $insert_time = $rename_time = time();
    if ($insertApiKey === null) {
        $insert_api_key_id = $insert_api_key_name = 'null';
    } else {

        $insert_api_key_id = $insertApiKey->id;

        $keyName = $insertApiKey->name;
        $insert_api_key_name = "'".$mysqli->real_escape_string($keyName)."'";

    }

    $sql = 'insert into folders'
        .' (id_users, parent_id, name, insert_time,'
        .' rename_time, insert_api_key_id, insert_api_key_name)'
        ." values ($id_users, $parent_id, '$name', $insert_time,"
        ." $rename_time, $insert_api_key_id, $insert_api_key_name)";

    $mysqli->query($sql) || trigger_error($mysqli->error);

    return $mysqli->insert_id;

}
