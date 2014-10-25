<?php

namespace ChannelName;

function isValid ($channelName) {

    include_once __DIR__.'/isShort.php';
    if (isShort($channelName)) return false;

    include_once __DIR__.'/isLong.php';
    if (isLong($channelName)) return false;

    include_once __DIR__.'/containsIllegalChars.php';
    if (containsIllegalChars($channelName)) return false;

    return true;

}
