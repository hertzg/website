<?php

$fnsDir = '../../../../fns';

include_once "$fnsDir/signed_user.php";
$user = signed_user();

include_once "$fnsDir/request_strings.php";
list($keyword) = request_strings('keyword');

include_once "$fnsDir/str_collapse_spaces.php";
$keyword = str_collapse_spaces($keyword);

if ($keyword === '') {
    include_once "$fnsDir/redirect.php";
    redirect('..');
}

$regex = '/('.preg_quote($keyword, '/').')+/i';
$replace = '<mark>$1</mark>';

include_once "$fnsDir/SearchForm/content.php";
$searchContent = SearchForm\content($keyword, 'Search page...', '..');

include_once "$fnsDir/SearchForm/create.php";
$items = [SearchForm\create('./', $searchContent)];

$found = false;

include_once '../fns/get_methods.php';
include_once "$fnsDir/Page/imageLinkWithDescription.php";
foreach (get_methods() as $name => $description) {
    if (strpos($name, $keyword) !== false) {
        $found = true;
        $title = preg_replace($regex, $replace, $name);
        $items[] = Page\imageLinkWithDescription($title,
            $description, "../$name/", 'api-method');
    }
}

include_once 'fns/get_full_groups.php';
include_once "$fnsDir/Page/imageLinkWithDescription.php";
foreach (get_full_groups() as $groupKey => $group) {

    if (strpos($groupKey, $keyword) !== false) {
        $found = true;
        $title = preg_replace($regex, $replace, $groupKey);
        $items[] = Page\imageLinkWithDescription($title,
            $group['description'], "../$groupKey/", 'api-namespace');
    }

    foreach ($group['methods'] as $name => $description) {
        $title = "$groupKey/$name";
        if (strpos($title, $keyword) !== false) {
            $found = true;
            $title = preg_replace($regex, $replace, $title);
            $href = "../$groupKey/$name/";
            $items[] = Page\imageLinkWithDescription($title,
                $description, $href, 'api-method');
        }
    }

}

if (!$found) {
    include_once "$fnsDir/Page/info.php";
    $items[] = Page\info('No pages found');
}

include_once 'fns/create_content.php';
$content = create_content($items);

include_once "$fnsDir/compressed_js_script.php";
$scripts = compressed_js_script('searchForm', '../../../../');

include_once '../../../fns/echo_admin_page.php';
echo_admin_page($user, 'Search Admin API Documentation',
    $content, '../../../', ['scripts' => $scripts]);
