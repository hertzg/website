<?php

function get_mysqli () {
    static $mysqli;
    if ($mysqli === null) {

        include_once __DIR__.'/../fns/MysqlConfig/get.php';
        MysqlConfig\get($host, $username, $password, $db);

        $mysqli = @new mysqli($host, $username, $password, $db);

        if ($mysqli->connect_errno) {
            error_log('MySQL error: '.json_encode($mysqli->connect_error));
            include_once __DIR__.'/ErrorPage/internalServerError.php';
            ErrorPage\internalServerError();
        }

        $mysqli->set_charset('utf8');

    }
    return $mysqli;
}
