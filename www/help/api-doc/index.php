<?php

include_once '../../../lib/defaults.php';

$base = '../../';
$fnsDir = '../../fns';

include_once "$fnsDir/signed_user.php";
$user = signed_user();

unset($_SESSION['help/messages']);

include_once 'fns/get_groups.php';
$groups = get_groups();

include_once "$fnsDir/SearchForm/emptyContent.php";
$searchContent = SearchForm\emptyContent('Search page...');

include_once "$fnsDir/SearchForm/create.php";
$items = [SearchForm\create('search/', $searchContent)];

include_once 'fns/get_methods.php';
include_once "$fnsDir/Page/imageArrowLinkWithDescription.php";
foreach (get_methods() as $name => $description) {
    $items[] = Page\imageArrowLinkWithDescription(
        $name, $description, "$name/", 'api-method', ['id' => $name]);
}

$group_items = [];
foreach ($groups as $key => $group) {
    $group_items[] = Page\imageArrowLinkWithDescription($group['title'],
        "$group[description].", "$key/", 'api-namespace', ['id' => $key]);
}

include_once 'fns/get_article_text.php';
include_once "$fnsDir/Page/panel.php";
include_once "$fnsDir/Page/create.php";
include_once "$fnsDir/Page/imageArrowLink.php";
include_once "$fnsDir/Page/text.php";
$content =
    Page\create(
        [
            'title' => 'Help',
            'href' => '../#api-doc',
            'localNavigation' => true,
        ],
        'API Documentation',
        Page\text(get_article_text())
        .'<div class="hr"></div>'
        .Page\imageArrowLink('PHP Example', 'php-example',
            'unknown-file', ['id' => 'php-example'])
        .'<div class="hr"></div>'
        .Page\text(
            'When accessing an API method with an API key'
            .' the following errors are expected:'
            .'<br /><code>INVALID_API_KEY</code> - The API key is invalid.'
            .'<br /><code>API_KEY_EXPIRED</code> - The API key is expired.'
            .'<br /><code>ACCESS_DENIED</code> - '
            .'The API key doesn\'t have a permission to perform the action.'
            .'<br /><code>USER_DISABLED</code> - '
            .'The user account is disabled.'
        )
        .'<div class="hr"></div>'
        .Page\text(
            'When accessing an API method with an authenticated session'
            .' the following errors are expected:'
            .'<br /><code>CROSS_DOMAIN_REQUEST</code>'
            .' - The request was referred by a different domain.'
            .'<br /><code>NOT_SIGNED_IN</code>'
            .' - The user has already signed out.'
            .'<br /><code>USER_DISABLED</code> - '
            .'The user account is disabled.'
            .'<br /><code>USER_PASSWORD_RESET</code> - The user password'
            .' has been reset by an administrator and it needs to be changed.'
        )
    )
    .\Page\panel('Methods', join('<div class="hr"></div>', $items))
    .\Page\panel('Namespaces',
        join('<div class="hr"></div>', $group_items));

include_once "$fnsDir/compressed_js_script.php";
include_once "$fnsDir/echo_public_page.php";
echo_public_page($user, 'API Documentation', $content, $base, [
    'scripts' => compressed_js_script('searchForm', $base),
]);
