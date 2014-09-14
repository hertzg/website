<?php

function get_zvini_client () {
    include_once __DIR__.'/get_domain_name.php';
    include_once __DIR__.'/get_zvini_client_key.php';
    include_once __DIR__.'/../classes/ZviniClient.php';
    return new ZviniClient(get_zvini_client_key(), get_domain_name());
}
