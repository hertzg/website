<?php

function get_mysqli () {

    include_once __DIR__.'/MysqlConfig/get.php';
    MysqlConfig\get($host, $username, $password, $db);

    return @new mysqli($host, $username, $password, $db);

}
