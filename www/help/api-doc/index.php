<?php

include_once '../../fns/signed_user.php';
$user = signed_user();

unset($_SESSION['help/messages']);

include_once '../../fns/get_domain_name.php';
$domain_name = get_domain_name();

include_once '../../fns/get_site_base.php';
$siteBase = get_site_base();

include_once '../../fns/get_site_protocol.php';
$site_protocol = get_site_protocol();

$api_base = "$site_protocol://$domain_name{$siteBase}api-call/";

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
            'title' => 'Help',
            'href' => '..',
        ],
    ],
    'API Documentation',
    Page\text(
        'Zvini API allows programs to access, modify'
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
    )
    .'<div class="hr"></div>'
    .Page\imageArrowLink('PHP Example', 'php-example', 'generic')
    .'<div class="hr"></div>'
    .Page\text(
        'Below is a list of errors that are expected from any API method:'
        .'<br /><code>INVALID_API_KEY</code> - The API Key is invalid.'
        .'<br /><code>API_KEY_EXPIRED</code> - The API Key is expired.'
        .'<br /><code>ACCESS_DENIED</code> - '
        .'The API Key doesn\'t have a permission to perform the action.'
    )
    .create_panel('Root Namespaces', join('<div class="hr"></div>', $items))
);

include_once '../../fns/echo_page.php';
echo_page($user, 'API Documentation', $content, '../../');
