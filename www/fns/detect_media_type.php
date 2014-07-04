<?php

function detect_media_type ($name) {
    $extension = pathinfo($name, PATHINFO_EXTENSION);
    $extension = strtolower($extension);
    if (preg_match('/^flac|mp3|oga|wav$/', $extension)) return 'audio';
    if (preg_match('/^bmp|gif|jpe?g|png|svg$/', $extension)) return 'image';
    if (preg_match('/^mp4|ogg|ogv$/', $extension)) return 'video';
}
