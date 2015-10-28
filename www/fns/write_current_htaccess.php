<?php

function write_current_htaccess () {

    include_once __DIR__.'/SiteBase/get.php';
    $siteBase = SiteBase\get();

    include_once __DIR__.'/DomainName/get.php';
    $domainName = DomainName\get();

    include_once __DIR__.'/SiteProtocol/get.php';
    $siteProtocol = SiteProtocol\get();

    include_once __DIR__.'/write_htaccess.php';
    write_htaccess($siteBase, $domainName, $siteProtocol);

}
