<?php

namespace ChannelUsers;

function delete ($mysqli, $id) {
    $sql = "delete from channel_users where id = $id";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
