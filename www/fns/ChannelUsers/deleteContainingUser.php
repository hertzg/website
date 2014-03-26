<?php

namespace ChannelUsers;

function deleteContainingUser ($mysqli, $id_users) {
    $sql = "delete from channel_users where id_users = $id_users"
        ." or subscribed_id_users = $id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
