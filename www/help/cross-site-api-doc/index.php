<?php

include_once '../../../lib/defaults.php';

$fnsDir = '../../fns';

include_once "$fnsDir/signed_user.php";
$user = signed_user();

unset($_SESSION['help/messages']);

include_once "$fnsDir/get_absolute_base.php";
$absolute_base = get_absolute_base();

$api_base = "{$absolute_base}cross-site-api-call/";

include_once 'fns/get_methods.php';
$methods = get_methods();

$items = [];
include_once "$fnsDir/Page/imageArrowLinkWithDescription.php";
foreach ($methods as $name => $description) {
    $items[] = Page\imageArrowLinkWithDescription($name,
        $description, "$name/", 'api-method', ['id' => $name]);
}

include_once "$fnsDir/create_panel.php";
include_once "$fnsDir/Page/create.php";
include_once "$fnsDir/Page/text.php";
$content =
    Page\create(
        [
            'title' => 'Help',
            'href' => '../#cross-site-api-doc',
            'localNavigation' => true,
        ],
        'Cross-site API Documentation',
        Page\text(
            '<em class="term">Zvini Cross-site API</em> allows websites'
            .' to access user data by first obtaining a cross-site API key'
            .' and then by calling API methods with HTTP requests.'
            .' The API methods can be called with either GET or POST methods.'
            ." The base URL of all the methods is <code>$api_base</code>."
            .' The response returned from the server is a JSON document.'
            .'<br />'
            .'<br />'
            .' To access an API method a website requires'
            ." a cross-site API key. It's a random password."
            .' To obtain the key the website should redirect to'
            ." <code>{$absolute_base}confirm-website/</code> and pass"
            .' the <code>url</code> parameter containing the address'
            .' that the cross-site API key is to be issued for.'
            .' After successful confirmation the browser will be'
            .' redirected to the website located at <code>url</code>'
            .' with added <code>cross_site_api_key</code> parameter.'
            .' To call a API method the <code>cross_site_api_key</code>'
            .' parameter should be present and its value'
            .' should be the issued random password.'
        )
    )
    .create_panel('Methods', join('<div class="hr"></div>', $items));

include_once "$fnsDir/echo_public_page.php";
echo_public_page($user, 'Cross-site API Documentation', $content, '../../');
