<?php

function get_users_connection ($mysqli, $user, $connected_id_users) {

    include_once __DIR__.'/Connections/getByConnectedUser.php';
    $connection = Connections\getByConnectedUser($mysqli,
        $user->id_users, $connected_id_users);

    if ($connection) {
        return [
            'can_send_channel' => $connection->can_send_channel,
        ];
    }

    return [
        'can_send_channel' => $user->anonymous_can_send_channel,
    ];

}
