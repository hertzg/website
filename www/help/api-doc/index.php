<?php

include_once '../../fns/signed_user.php';
$user = signed_user();

$api_base = 'https://zvini.com/api-call/';

include_once 'fns/get_groups.php';
$groups = get_groups();

include_once '../../fns/SearchForm/emptyContent.php';
$searchContent = SearchForm\emptyContent('Search page...');

include_once '../../fns/SearchForm/create.php';
$items = [SearchForm\create('search/', $searchContent)];

include_once '../../fns/Page/imageArrowLinkWithDescription.php';
foreach ($groups as $key => $group) {
    $items[] = Page\imageArrowLinkWithDescription($group['title'],
        "$group[description].", "$key/", 'generic');
}

include_once '../../fns/create_panel.php';
include_once '../../fns/Page/imageArrowLink.php';
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
            .'Zvini API allows programs to access, modify'
            .' and delete user data using HTTP and JSON.'
            .' Programs are given API keys with which they call API methods.'
            .' The API methods can be called with either GET or POST methods.'
            .' The methods parameters can be passed either in'
            .' a query string or as a URL-encoded form data'
            .' or as a multipart form data. The API key parameter'
            .' <code>api_key</code> should be present in all requests.'
            ." The base URL of all the API methods is <code>$api_base</code>."
            .' The response returned from the server is either a JSON document'
            .' or binary data in case of file downloads.'
            .' Click below to see a PHP example code that calls an API method.'
        .'</div>'
    )
    .'<div class="hr"></div>'
    .Page\imageArrowLink('PHP Example', 'php-example', 'generic')
    .create_panel('Root Namespaces', join('<div class="hr"></div>', $items))
);

include_once '../../fns/echo_page.php';
echo_page($user, 'API Documentation', $content, '../../');
