<?php

function get_article_text () {

    include_once __DIR__.'/../../../fns/get_absolute_base.php';
    $api_base = get_absolute_base().'api-call/';

    return
        '<em class="term">Zvini API</em> allows programs to access,'
        .' modify and delete user data by calling API methods with HTTP.'
        .' The API methods can be called with either GET or POST methods.'
        .' The method parameters can be passed either as a query string'
        .' or as a URL-encoded form data or as a multipart form data.'
        ." The base URL of all the methods is <code>$api_base</code>."
        .' The response returned from the server is'
        .' either a JSON document or binary data.'
        .'<br />'
        .'<br />'
        .' There are two ways to access an API method.'
        .' A program requires either of the following:'
        .'<br />'
        .'<br />'
        .'1. An API key. It\'s a random password.'
        .' Users can generate multiples of them from'
        .' "Home" &gt; "Account" &gt; "API Keys" page.'
        .' To call a method this way an <code>api_key</code>'
        .' parameter should be present and its value'
        .' should be the generated random password.'
        .'<br />'
        .'<br />'
        .'2. An authenticated session.'
        .' In this case a user should already be signed in.'
        .' To call a method this way a <code>session_auth</code>'
        .' parameter should be present and its value'
        .' should be equal to a truthy value (e.g. 1).'
        .'<br />'
        .'<br />'
        .'Click below to see a PHP example code that calls an API method.';

}
