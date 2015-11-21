<?php

namespace ChannelName;

function request () {

    include_once __DIR__.'/../request_strings.php';
    list($channel_name) = request_strings('channel_name');

    include_once __DIR__.'/maxLength.php';
    return mb_substr($channel_name, 0, maxLength(), 'UTF-8');

}
