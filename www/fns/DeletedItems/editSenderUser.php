<?php

namespace DeletedItems;

function editSenderUser ($mysqli, $sender_id_users, $username) {

    $sql = 'select * from deleted_items where data_type in'
        ." ('receivedBookmark', 'receivedCalculation',"
        ." 'receivedContact', 'receivedFile', 'receivedFolder'"
        .", 'receivedNote', 'receivedPlace', 'receivedTask')";
    include_once __DIR__.'/../mysqli_query_object.php';
    $deletedItems = mysqli_query_object($mysqli, $sql);

    foreach ($deletedItems as $deletedItem) {
        $data = json_decode($deletedItem->data_json);
        if ($data->sender_id_users == $sender_id_users) {
            $data->sender_username = $username;
            $data_json = json_encode($data);
            $sql = "update deleted_items set data_json = '$data_json'"
                ." where id = $deletedItem->id";
            $mysqli->query($sql) || trigger_error($mysqli->error);
        }
    }

}
