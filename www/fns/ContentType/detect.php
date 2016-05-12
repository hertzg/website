<?php

namespace ContentType;

function detect ($name) {
    static $contentTypes = [
        '3gp' => 'video/3gpp',
        'bmp' => 'image/bmp',
        'gif' => 'image/gif',
        'gpx' => 'application/gpx+xml',
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
        'zip' => 'application/zip',
        'zipx' => 'application/zip',
    ];
    $extension = pathinfo($name, PATHINFO_EXTENSION);
    $extension = strtolower($extension);
    if (array_key_exists($extension, $contentTypes)) {
        return $contentTypes[$extension];
    }
    return 'application/octet-stream';
}
