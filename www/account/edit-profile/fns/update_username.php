<?php

function update_username ($mysqli, $id_users, $username) {

    $data = [
        ['channels', 'id_users', 'username'],
        ['connections', 'id_users', 'username'],
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

}
