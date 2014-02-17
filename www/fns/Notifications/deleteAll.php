<?php

namespace Notifications;

function deleteAll ($mysqli, $idusers) {
    mysqli_query($mysqli, "delete from notifications where idusers = $idusers");
}
