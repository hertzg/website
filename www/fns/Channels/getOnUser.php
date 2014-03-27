<?php

namespace Channels;

function getOnUser ($mysqli, $idusers, $id) {
    include_once __DIR__.'/get.php';
    $channel = get($mysqli, $id);
    if ($channel && $channel->idusers == $idusers) {
        return $channel;
    }
}
