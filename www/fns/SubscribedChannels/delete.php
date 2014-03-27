<?php

namespace SubscribedChannels;

function delete ($mysqli, $id) {
    $sql = "delete from subscribed_channels where id = $id";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
