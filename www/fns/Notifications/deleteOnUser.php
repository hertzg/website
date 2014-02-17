<?php

namespace Notifications;

function deleteOnUser ($mysqli, $idusers) {
    mysqli_query($mysqli, "delete from notifications where idusers = $idusers");
}
