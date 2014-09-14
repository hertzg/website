<?php

function get_zvini_client () {

    include_once __DIR__.'/get_site_base.php';
    $siteBase = get_site_base();

    include_once __DIR__.'/get_domain_name.php';
    $domain_name = get_domain_name();

    include_once __DIR__.'/get_zvini_client_key.php';
    include_once __DIR__.'/../classes/ZviniClient.php';
    return new ZviniClient(get_zvini_client_key(), $domain_name, $siteBase);

}
