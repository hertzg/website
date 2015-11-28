<?php

function get_zvini_client () {
    include_once __DIR__.'/get_zvini_client_key.php';
    include_once __DIR__.'/get_absolute_base.php';
    include_once __DIR__.'/../classes/ZviniClient.php';
    return new ZviniClient(get_zvini_client_key(), get_absolute_base());
}
