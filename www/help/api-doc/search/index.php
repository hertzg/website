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
$regex = '/('.preg_quote($lowerKeyword, '/').')+/i';
$replace = '<mark>$1</mark>';

include_once '../../../fns/SearchForm/content.php';
$searchContent = SearchForm\content($keyword, 'Search page...', '..');

include_once '../../../fns/SearchForm/create.php';
$items = [SearchForm\create('./', $searchContent)];

include_once '../fns/bookmark/get_subgroups.php';
include_once '../fns/channel/get_subgroups.php';
include_once '../fns/contact/get_subgroups.php';
include_once '../fns/file/get_subgroups.php';
include_once '../fns/note/get_subgroups.php';
include_once '../fns/task/get_subgroups.php';
$groupSubgroups = [
    'bookmark' => bookmark\get_subgroups(),
    'channel' => channel\get_subgroups(),
    'contact' => contact\get_subgroups(),
    'file' => file\get_subgroups(),
    'note' => note\get_subgroups(),
    'task' => task\get_subgroups(),
];

include_once '../../../fns/Page/imageLinkWithDescription.php';
include_once '../fns/get_groups.php';
$groups = get_groups();
foreach ($groups as $groupKey => $group) {
    if (strpos($groupKey, $lowerKeyword) !== false) {
        $title = preg_replace($regex, $replace, $groupKey);
        $items[] = Page\imageLinkWithDescription($title,
            $group['description'], "../$groupKey/", 'generic');
    }
    if (array_key_exists($groupKey, $groupSubgroups)) {
        foreach ($groupSubgroups[$groupKey] as $subgroupKey => $subgroup) {
            $fullKey = "$groupKey/$subgroupKey";
            if (strpos($fullKey, $lowerKeyword) !== false) {
                $title = preg_replace($regex, $replace, $fullKey);
                $href = "../$groupKey/$subgroupKey";
                $items[] = Page\imageLinkWithDescription($title,
                    $subgroup['description'], $href, 'generic');
            }
        }
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
