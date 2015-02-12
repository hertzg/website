<?php

namespace SubscribedChannels;

function editNumbers ($mysqli, $id, $num_notifications) {
    $sql = 'update subscribed_channels set'
        ." num_notifications = $num_notifications where id = $id";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
