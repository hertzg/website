<?php

$base = '../../../';

include_once '../../../fns/require_user.php';
$user = require_user($base);

include_once '../../../fns/request_strings.php';
list($keyword) = request_strings('keyword');

include_once '../../../fns/str_collapse_spaces.php';
$keyword = str_collapse_spaces($keyword);

if ($keyword === '') {
    include_once '../../../fns/redirect.php';
    redirect('..');
}

$lowerKeyword = mb_strtolower($keyword, 'UTF-8');
$regex = '/'.preg_quote($lowerKeyword).'/i';

include_once '../../../fns/SearchForm/content.php';
$searchContent = SearchForm\content($keyword, 'Search page...', '..');

include_once '../../../fns/SearchForm/create.php';
$items = [SearchForm\create('./', $searchContent)];

include_once '../../../fns/Page/imageLinkWithDescription.php';
include_once '../fns/get_groups.php';
$rootGroups = get_groups();
foreach ($rootGroups as $key => $rootGroup) {
    if (strpos($key, $lowerKeyword) !== false) {
        $title = preg_replace($regex, '<mark>$0</mark>', $rootGroup['title']);
        $items[] = Page\imageLinkWithDescription($title,
            $rootGroup['description'], "../$key/", 'generic');
    }
}

include_once '../../../fns/Page/tabs.php';
$content = Page\tabs(
    [
        [
            'title' => '&middot;&middot;&middot;',
            'href' => '../../../home/'
        ],
        [
            'title' => 'Help',
            'href' => '../..',
        ],
    ],
    'API Documentation',
    join('<div class="hr"></div>', $items)
);

include_once '../../../fns/echo_page.php';
echo_page($user, 'Search API Documentation', $content, $base);
