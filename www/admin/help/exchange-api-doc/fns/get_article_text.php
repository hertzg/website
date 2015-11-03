<?php

function get_article_text () {

    $fnsDir = __DIR__.'/../../../../fns';

    include_once "$fnsDir/DomainName/get.php";
    $domainName = DomainName\get();

    include_once "$fnsDir/SiteBase/get.php";
    $siteBase = SiteBase\get();

    include_once "$fnsDir/SiteProtocol/get.php";
    $siteProtocol = SiteProtocol\get();

    $api_base = "$siteProtocol://$domainName{$siteBase}exchange-api-call/";

    return
        '<em class="term">Zvini Exchange API</em> allows programs'
        .' such as other Zvini instances to transport user data to each other'
        .' by calling API methods with HTTP requests.'
        .' The API methods can be called with either GET or POST methods.'
        .' The method parameters can be passed either as a'
        .' query string or as a URL-encoded form data.'
        ." The base URL of all the methods is <code>$api_base</code>."
        .' The response returned from the server is a JSON document.'
        .'<br />'
        .'<br />'
        .' To access an API method a program will require an exchange API key.'
        .' It\'s a random password. Administrators can generate multiples'
        .' of them from "Administration" &gt; "Manage Connections" page.'
        .' To call a method an <code>exchange_api_key</code>'
        .' parameter should be present and its value'
        .' should be the generated random password.'
        .'<br />'
        .'<br />'
        .' Click below to see a PHP example code'
        .' that calls an exchange API method:';

}
