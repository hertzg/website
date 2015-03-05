<?php

namespace ContentType;

function column () {
    return [
        'type' => "enum('audio/flac','audio/mp3','audio/wav',"
            ."'image/bmp','image/gif','image/jpeg','image/png',"
            ."'image/svg+xml','video/mp4','audio/ogg','video/ogg')",
        'characterSet' => 'ascii',
        'collation' => 'ascii_bin',
    ];
}
