<?php

function get_users_connection ($mysqli, $user, $connected_id_users) {

    $id_users = $user->id_users;
    if ($id_users == $connected_id_users) {
        return [
            'can_send_bookmark' => true,
            'can_send_channel' => true,
            'can_send_contact' => true,
            'can_send_file' => true,
            'can_send_note' => true,
            'can_send_place' => true,
            'can_send_schedule' => true,
            'can_send_task' => true,
        ];
    }

    include_once __DIR__.'/Connections/getByConnectedUser.php';
    $connection = Connections\getByConnectedUser($mysqli,
        $id_users, $connected_id_users);

    if ($connection) {
        $expire_time = $connection->expire_time;
        if ($expire_time === null || $expire_time >= time()) {
            return [
                'can_send_bookmark' => $connection->can_send_bookmark,
                'can_send_channel' => $connection->can_send_channel,
                'can_send_contact' => $connection->can_send_contact,
                'can_send_file' => $connection->can_send_file,
                'can_send_note' => $connection->can_send_note,
                'can_send_place' => $connection->can_send_place,
                'can_send_schedule' => $connection->can_send_schedule,
                'can_send_task' => $connection->can_send_task,
            ];
        }
    }

    return [
        'can_send_bookmark' => $user->anonymous_can_send_bookmark,
        'can_send_channel' => $user->anonymous_can_send_channel,
        'can_send_contact' => $user->anonymous_can_send_contact,
        'can_send_file' => $user->anonymous_can_send_file,
        'can_send_note' => $user->anonymous_can_send_note,
        'can_send_place' => $user->anonymous_can_send_place,
        'can_send_schedule' => $user->anonymous_can_send_schedule,
        'can_send_task' => $user->anonymous_can_send_task,
    ];

}
