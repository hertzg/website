<?php

namespace Notifications;

function deleteOnChannel ($mysqli, $idchannels) {
    $sql = "delete from notifications where idchannels = $idchannels";
    $mysqli->query($sql);
}
