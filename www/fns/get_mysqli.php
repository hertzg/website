<?php

function get_mysqli () {
    static $mysqli;
    if ($mysqli === null) {
        include_once __DIR__.'/../lib/config.php';
        $config = $mysqli;
        $mysqli = new mysqli($config['host'], $config['user'], $config['pass'], $config['db']);
        if ($mysqli->connect_errno) {
            include_once __DIR__.'/ErrorPage/internalServerError.php';
            ErrorPage\internalServerError();
        }
        $mysqli->set_charset('utf8');
    }
    return $mysqli;
}
