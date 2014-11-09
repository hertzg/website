<?php

$base = '../../';
$fnsDir = '../../fns';

include_once "$fnsDir/signed_user.php";
$user = signed_user();

unset($_SESSION['help/messages']);

include_once "$fnsDir/DomainName/get.php";
$domainName = DomainName\get();

include_once "$fnsDir/SiteBase/get.php";
$siteBase = SiteBase\get();

include_once "$fnsDir/SiteProtocol/get.php";
$siteProtocol = SiteProtocol\get();

$api_base = "$siteProtocol://$domainName{$siteBase}api-call/";

include_once 'fns/get_groups.php';
$groups = get_groups();

include_once "$fnsDir/SearchForm/emptyContent.php";
$searchContent = SearchForm\emptyContent('Search page...');

include_once "$fnsDir/SearchForm/create.php";
$items = [SearchForm\create('search/', $searchContent)];

include_once "$fnsDir/Page/imageArrowLinkWithDescription.php";
foreach ($groups as $key => $group) {
    $items[] = Page\imageArrowLinkWithDescription($group['title'],
        "$group[description].", "$key/", 'generic');
}

include_once "$fnsDir/compressed_js_script.php";
include_once "$fnsDir/create_panel.php";
include_once "$fnsDir/Page/imageArrowLink.php";
include_once "$fnsDir/Page/tabs.php";
include_once "$fnsDir/Page/text.php";
$content =
    Page\tabs(
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
    )
    .compressed_js_script('searchForm', $base);

include_once "$fnsDir/echo_page.php";
echo_page($user, 'API Documentation', $content, $base);
