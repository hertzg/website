<?php

namespace Channels;

function request () {

    include_once __DIR__.'/../request_strings.php';
    list($channel_name, $public) = request_strings('channel_name', 'public');

    $public = (bool)$public;

    return [$channel_name, $public];

}
