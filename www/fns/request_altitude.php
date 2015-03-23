<?php

function request_altitude (&$altitude, &$parsed_altitude) {

    include_once __DIR__.'/request_strings.php';
    list($altitude) = request_strings('altitude');

    $altitude = preg_replace('/\s+/', '', $altitude);

    if ($altitude === '') $parsed_altitude = null;
    else $parsed_altitude = (float)$altitude;

}
