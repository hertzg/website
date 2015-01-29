<?php

namespace DeletedItems;

function add ($mysqli, $id_users, $data_type, $data_json, $insertApiKey) {

    $data_json = json_encode($data_json);
    $data_json = $mysqli->real_escape_string($data_json);
    $insert_time = $update_time = time();
    if ($insertApiKey === null) {
        $insert_api_key_id = $insert_api_key_name = 'null';
    } else {

        $insert_api_key_id = $insertApiKey->id;

        $name = $insertApiKey->name;
        $insert_api_key_name = "'".$mysqli->real_escape_string($name)."'";

    }

    $sql = 'insert into deleted_items'
        .' (id_users, insert_time, data_type, data_json,'
        .' insert_api_key_id, insert_api_key_name)'
        ." values ($id_users, $insert_time, '$data_type', '$data_json',"
        ." $insert_api_key_id, $insert_api_key_name)";

    $mysqli->query($sql) || trigger_error($mysqli->error);

    return $mysqli->insert_id;

}
