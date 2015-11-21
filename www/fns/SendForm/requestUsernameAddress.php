<?php

namespace SendForm;

function requestUsernameAddress (&$username, &$parsed_username, &$address) {

    $fnsDir = __DIR__.'/..';

    include_once "$fnsDir/request_strings.php";
    list($username) = request_strings('username');
    $username = preg_replace('/\s+/', '', $username);

    include_once "$fnsDir/parse_username_address.php";
    parse_username_address($username, $parsed_username, $address);

    if ($address !== null) {

        include_once "$fnsDir/SiteProtocol/get.php";
        $siteProtocol = \SiteProtocol\get();

        include_once "$fnsDir/DomainName/get.php";
        $domainName = \DomainName\get();

        include_once "$fnsDir/SiteBase/get.php";
        $siteBase = \SiteBase\get();

        if ($address === "$siteProtocol://$domainName$siteBase") {
            $username = $parsed_username;
            $address = null;
        }

    }

}
