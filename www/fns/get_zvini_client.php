<?php

function get_zvini_client () {

    include_once __DIR__.'/get_zvini_client_key.php';
    $key = get_zvini_client_key();

    include_once __DIR__.'/SiteBase/get.php';
    $siteBase = SiteBase\get();

    include_once __DIR__.'/DomainName/get.php';
    $domainName = DomainName\get();

    include_once __DIR__.'/SiteProtocol/get.php';
    $siteProtocol = SiteProtocol\get();

    include_once __DIR__.'/../classes/ZviniClient.php';
    return new ZviniClient($key, $domainName, $siteBase, $siteProtocol);

}
