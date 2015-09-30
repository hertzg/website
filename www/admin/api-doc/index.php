<?php

include_once 'fns/unset_session_vars.php';
unset_session_vars();

$fnsDir = '../../fns';

include_once 'fns/get_groups.php';
$groups = get_groups();

include_once "$fnsDir/SearchForm/emptyContent.php";
$searchContent = SearchForm\emptyContent('Search page...');

include_once "$fnsDir/SearchForm/create.php";
$items = [SearchForm\create('search/', $searchContent)];

include_once "$fnsDir/Page/imageArrowLinkWithDescription.php";
foreach ($groups as $key => $group) {
    $items[] = Page\imageArrowLinkWithDescription($group['title'],
        "$group[description].", "$key/", 'api-namespace', ['id' => $key]);
}

include_once "$fnsDir/create_panel.php";
include_once "$fnsDir/Page/tabs.php";
$content = Page\tabs(
    [
        [
            'title' => 'Administration',
            'href' => '../#api-doc',
        ],
    ],
    'Admin API Documentation',
    join('<div class="hr"></div>', $items)
);

include_once '../fns/echo_admin_page.php';
include_once "$fnsDir/compressed_js_script.php";
echo_admin_page('Admin API Documentation', $content, '../', [
    'scripts' => compressed_js_script('searchForm', '../../'),
]);
