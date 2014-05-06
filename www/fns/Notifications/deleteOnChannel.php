<?php

namespace Notifications;

function deleteOnChannel ($mysqli, $id_channels) {
    $sql = "delete from notifications where id_channels = $id_channels";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
