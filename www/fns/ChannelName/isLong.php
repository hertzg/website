<?php

namespace ChannelName;

function isLong ($channelName) {
    include_once __DIR__.'/maxLength.php';
    return mb_strlen($channelName, 'UTF-8') > maxLength();
}
