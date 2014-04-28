<?php

$base = '../../';

include_once '../../fns/require_user.php';
$user = require_user($base);

$api_base = 'https://zvini.com/api-call/';

include_once '../../fns/create_panel.php';
include_once '../../fns/Page/imageLink.php';
include_once '../../fns/Page/tabs.php';
include_once '../../fns/Page/text.php';
$content = Page\tabs(
    [
        [
            'title' => '&middot;&middot;&middot;',
            'href' => '../../home/'
        ],
        [
            'title' => 'Help',
            'href' => '..',
        ],
    ],
    'API Documentation',
    Page\text(
        '<div>'
            .'Zvini API allows programs to access, modify and delete user data using HTTP and JSON.'
            .' Programs are given API keys with which they call API methods.'
            .' The API methods can be called with either GET or POST methods.'
            .' The methods parameters can be passes either in a query string or as a URL-encoded form data.'
            .' The API key parameter <code>api_key</code> should be present in all requests.'
            ." The base URL of all the API methods is <code>$api_base</code>."
            .' The response returned from the server is always a JSON document.'
            .' Click below to see a PHP example code that calls an API method.'
        .'</div>'
    )
    .'<div class="hr"></div>'
    .Page\imageLink('PHP Example', 'php-example', 'generic')
    .'<div class="hr"></div>'
    .create_panel(
        'API Methods',
        Page\imageLink('Bookmark Methods', 'bookmark/', 'generic')
        .'<div class="hr"></div>'
        .Page\imageLink('Contact Methods', 'contact/', 'generic')
        .'<div class="hr"></div>'
        .Page\imageLink('Note Methods', 'note/', 'generic')
        .'<div class="hr"></div>'
        .Page\imageLink('Notification Methods', 'notification/', 'generic')
        .'<div class="hr"></div>'
        .Page\imageLink('Task Methods', 'task/', 'generic')
    )
);

include_once '../../fns/echo_page.php';
echo_page($user, 'API Documentation', $content, $base);
