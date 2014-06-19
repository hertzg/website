<?php

namespace DeletedItems;

function add ($mysqli, $id_users, $data_type, $data_json) {

    $insert_time = time();
    $data_json = json_encode($data_json);
    $data_json = $mysqli->real_escape_string($data_json);

    $sql = 'insert into deleted_items'
        .' (id_users, insert_time, data_type, data_json)'
        ." values ($id_users, $insert_time, '$data_type', '$data_json')";

    $mysqli->query($sql) || trigger_error($mysqli->error);

    return $mysqli->insert_id;

}
