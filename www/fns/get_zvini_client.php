<?php

function get_zvini_client () {
    $key = '';
    include_once __DIR__.'/../classes/ZviniClient.php';
    return new ZviniClient($key);
}
