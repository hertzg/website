<?php

function get_zvini_client () {
    $api_key = '';
    include_once __DIR__.'/../classes/ZviniClient.php';
    return new ZviniClient($api_key);
}
