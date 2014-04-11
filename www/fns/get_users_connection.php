<?php

function get_users_connection ($mysqli, $user, $connected_id_users) {

    include_once __DIR__.'/Connections/getByConnectedUser.php';
    $connection = Connections\getByConnectedUser($mysqli,
        $user->id_users, $connected_id_users);

    if ($connection) {
        return [
            'can_send_bookmark' => $connection->can_send_bookmark,
            'can_send_channel' => $connection->can_send_channel,
            'can_send_contact' => $connection->can_send_contact,
            'can_send_file' => $connection->can_send_file,
            'can_send_note' => $connection->can_send_note,
            'can_send_task' => $connection->can_send_task,
        ];
    }

    return [
        'can_send_bookmark' => $user->anonymous_can_send_bookmark,
        'can_send_channel' => $user->anonymous_can_send_channel,
        'can_send_contact' => $user->anonymous_can_send_contact,
        'can_send_file' => $user->anonymous_can_send_file,
        'can_send_note' => $user->anonymous_can_send_note,
        'can_send_task' => $user->anonymous_can_send_task,
    ];

}
