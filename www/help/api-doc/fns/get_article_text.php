<?php

function get_article_text () {

    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/DomainName/get.php";
    $domainName = DomainName\get();

    include_once "$fnsDir/SiteBase/get.php";
    $siteBase = SiteBase\get();

    include_once "$fnsDir/SiteProtocol/get.php";
    $siteProtocol = SiteProtocol\get();

    $api_base = "$siteProtocol://$domainName{$siteBase}api-call/";

    return
        'Zvini API allows programs to access, modify'
        .' and delete user data by calling API methods with HTTP requests.'
        .' The API methods can be called with either GET or POST methods.'
        .' The method parameters can be passed'
        .' either as a query string or as a URL-encoded form data'
        .' or as a multipart form data.'
        ." The base URL of all the methods is <code>$api_base</code>."
        .' The response returned from the server is either a JSON document'
        .' or binary data in case of file downloads.'
        .'<br />'
        .'<br />'
        .' There are two ways to access an API method.'
        .' A program will require either of the following:'
        .'<br />'
        .'<br />'
        .' 1. An API key. It\'s a random password.'
        .' Users can generate multiples of them for their accounts.'
        .' To call a method this way an <code>api_key</code>'
        .' parameter should be present and its value'
        .' should be the generated random password.'
        .'<br />'
        .'<br />'
        .' 2. An authgenticated session.'
        .' In this case a user should already be signed in.'
        .' To call a method this way a <code>session_auth</code> parameter'
        .' should be present and its value should be equal'
        .' to a truthy value (e.g. 1).'
        .'<br />'
        .'<br />'
        .' Click below to see a PHP example code that calls an API method.';

}
