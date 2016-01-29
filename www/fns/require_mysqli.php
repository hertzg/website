<?php

function require_mysqli () {
    static $mysqli;
    if ($mysqli === null) {

        include_once __DIR__.'/get_mysqli.php';
        $mysqli = get_mysqli();

        if ($mysqli->connect_errno) {
            $error = 'MySQL error: '.json_encode($mysqli->connect_error);
            include_once __DIR__.'/ErrorPage/internalServerError.php';
            ErrorPage\internalServerError($error);
        }

        $mysqli->set_charset('utf8');

    }
    return $mysqli;
}
