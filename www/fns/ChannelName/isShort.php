<?php

namespace ChannelName;

function isShort ($channelName) {
    include_once __DIR__.'/minLength.php';
    return mb_strlen($channelName, 'UTF-8') < minLength();
}
