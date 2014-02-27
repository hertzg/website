<?php

namespace Notifications;

function deleteOnUser ($mysqli, $idusers) {
    $mysqli->query("delete from notifications where idusers = $idusers");
}
