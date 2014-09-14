<?php

namespace Channels;

function getOnUser ($mysqli, $id_users, $id) {
    include_once __DIR__.'/get.php';
    $channel = get($mysqli, $id);
    if ($channel && $channel->id_users == $id_users) return $channel;
}
