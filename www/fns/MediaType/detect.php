<?php

namespace MediaType;

function detect ($name) {

    $extension = pathinfo($name, PATHINFO_EXTENSION);
    $extension = strtolower($extension);

    if (preg_match('/^gz|rar|tgz|zip$/', $extension)) return 'archive';
    if (preg_match('/^flac|mp3|oga|wav$/', $extension)) return 'audio';
    if (preg_match('/^bmp|gif|ico|jpe?g|png|svg$/', $extension)) return 'image';

    $regex = '/^css|html?|ini|js|md|php|sh|txt|xml$/';
    if (preg_match($regex, $extension)) return 'text';

    if (preg_match('/^3gp|mp4|ogg|ogv$/', $extension)) return 'video';
    return 'unknown';

}
