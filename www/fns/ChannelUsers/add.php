<?php

namespace ChannelUsers;

function add ($mysqli, $id_channels, $id_users) {
    $insert_time = time();
    $sql = 'insert into channel_users (id_channels, id_users, insert_time)'
        ." values ($id_channels, $id_users, $insert_time)";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
