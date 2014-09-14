<?php

function get_zvini_client () {

    include_once __DIR__.'/get_zvini_client_key.php';
    $key = get_zvini_client_key();

    include_once __DIR__.'/get_site_base.php';
    $siteBase = get_site_base();

    include_once __DIR__.'/get_domain_name.php';
    $domain_name = get_domain_name();

    include_once __DIR__.'/get_site_protocol.php';
    $site_protocol = get_site_protocol();

    include_once __DIR__.'/../classes/ZviniClient.php';
    return new ZviniClient($key, $domain_name, $siteBase, $site_protocol);

}
