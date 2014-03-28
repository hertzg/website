<?php

function get_extension_content_type ($extension) {
    static $contentTypes = [
        'bmp' => 'image/bmp',
        'gif' => 'image/gif',
        'flac' => 'audio/flac',
        'jpeg' => 'image/jpeg',
        'jpg' => 'image/jpeg',
        'mp3' => 'audio/mp3',
        'mp4' => 'video/mp4',
        'oga' => 'audio/ogg',
        'ogg' => 'video/ogg',
        'ogv' => 'video/ogg',
        'png' => 'image/png',
        'svg' => 'image/svg+xml',
        'wav' => 'audio/wav',
    ];
    if (array_key_exists($extension, $contentTypes)) {
        return $contentTypes[$extension];
    }
    return 'application/octet-stream';
}
