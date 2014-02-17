<?php

namespace Notifications;

function deleteOnChannel ($mysqli, $idchannels) {
    $sql = "delete from notifications where idchannels = $idchannels";
    mysqli_query($mysqli, $sql);
}
