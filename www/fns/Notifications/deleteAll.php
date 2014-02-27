<?php

namespace Notifications;

function deleteAll ($mysqli, $idusers) {
    $mysqli->query("delete from notifications where idusers = $idusers");
}
