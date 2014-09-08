<?php

function update_username ($mysqli, $id_users, $username) {

    $data = [
        ['channels', 'id_users', 'username'],
        ['received_bookmarks', 'sender_id_users', 'sender_username'],
        ['received_contacts', 'sender_id_users', 'sender_username'],
        ['received_files', 'sender_id_users', 'sender_username'],
        ['received_folders', 'sender_id_users', 'sender_username'],
        ['received_notes', 'sender_id_users', 'sender_username'],
        ['received_tasks', 'sender_id_users', 'sender_username'],
        ['subscribed_channels', 'publisher_id_users', 'publisher_username'],
        ['subscribed_channels', 'subscriber_id_users', 'subscriber_username'],
    ];

    $username = $mysqli->real_escape_string($username);

    foreach ($data as $values) {
        list($table, $id_column, $username_column) = $values;
        $sql = "update $table set $username_column = '$username'"
            ." where $id_column = $id_users";
        $mysqli->query($sql) || trigger_error($mysqli->error);
    }

    $sql = 'select * from deleted_items where data_type in'
        ." ('receivedBookmark', 'receivedContact', 'receivedFile',"
        ." 'receivedFolder', 'receivedNote', 'receivedTask')";
    include_once __DIR__.'/../../../fns/mysqli_query_object.php';
    $deletedItems = mysqli_query_object($mysqli, $sql);

    foreach ($deletedItems as $deletedItem) {
        $data = json_decode($deletedItem->data_json);
        if ($data->sender_id_users == $id_users) {
            $data->sender_username = $username;
            $data_json = json_encode($data);
            $sql = "update deleted_items set data_json = '$data_json'"
                ." where id = $deletedItem->id";
            $mysqli->query($sql) || trigger_error($mysqli->error);
        }
    }

}
