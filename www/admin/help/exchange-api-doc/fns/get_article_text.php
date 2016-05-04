<?php

function get_article_text () {

    include_once __DIR__.'/../../../../fns/get_absolute_base.php';
    $api_base = get_absolute_base().'exchange-api-call/';

    return
        '<em class="term">Zvini Exchange API</em> allows programs'
        .' such as other Zvini instances to send user data'
        .' to this Zvini instance by calling API methods with HTTP.'
        .' The API methods can be called with either GET or POST methods.'
        .' The method parameters can be passed either as a'
        .' query string or as a URL-encoded form data.'
        ." The base URL of all the methods is <code>$api_base</code>."
        .' The response returned from the server is always a JSON document.'
        .'<br />'
        .'<br />'
        .'To access an API method a program requires an exchange API key.'
        .' It\'s a random password. Administrators can generate multiples'
        .' of them from "Administration" &gt; "Connections" page.'
        .' To call a method an <code>exchange_api_key</code>'
        .' parameter should be present and its value'
        .' should be the generated random password.'
        .'<br />'
        .'<br />'
        .'Click below to see a PHP example code'
        .' that calls an exchange API method:';

}
