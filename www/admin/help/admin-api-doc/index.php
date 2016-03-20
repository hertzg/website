<?php

include_once '../../../../lib/defaults.php';

$fnsDir = '../../../fns';

include_once "$fnsDir/signed_user.php";
$user = signed_user();

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
            'href' => '../#admin-api-doc',
            'localNavigation' => true,
        ],
        'Admin API Documentation',
        Page\text(get_article_text())
        .'<div class="hr"></div>'
        .Page\imageArrowLink('PHP Example',
            'php-example', 'generic', ['id' => 'php-example'])
        .'<div class="hr"></div>'
        .Page\text(
            'Below is a list of errors'
            .' that are expected from any admin API method:'
            .'<br /><code>INVALID_ADMIN_API_KEY</code> - '
            .'The admin API key is invalid.'
            .'<br /><code>ADMIN_API_KEY_EXPIRED</code> - '
            .'The admin API key is expired.'
            .'<br /><code>ACCESS_DENIED</code> - '
            .'The admin API key doesn\'t have'
            .' a permission to perform the action.'
        )
    )
    .\Page\panel('Methods', join('<div class="hr"></div>', $items))
    .\Page\panel('Namespaces',
        join('<div class="hr"></div>', $group_items));

include_once '../../fns/echo_admin_page.php';
include_once "$fnsDir/compressed_js_script.php";
echo_admin_page($user, 'Admin API Documentation', $content, '../../', [
    'scripts' => compressed_js_script('searchForm', '../../../'),
]);
