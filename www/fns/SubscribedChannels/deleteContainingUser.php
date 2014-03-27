<?php

namespace SubscribedChannels;

function deleteContainingUser ($mysqli, $id_users) {
    $sql = 'delete from subscribed_channels'
        ." where id_users = $id_users"
        ." or subscribed_id_users = $id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
