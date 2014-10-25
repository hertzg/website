<?php

namespace ChannelName;

function containsIllegalChars ($channelName) {
    return preg_match('/[^a-z0-9._-]/ui', $channelName);
}
