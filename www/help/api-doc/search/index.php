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

include_once 'fns/get_full_groups.php';
$groups = get_full_groups();

include_once '../../../fns/Page/imageLinkWithDescription.php';
foreach ($groups as $groupKey => $group) {

    if (strpos($groupKey, $lowerKeyword) !== false) {
        $title = preg_replace($regex, $replace, $groupKey);
        $items[] = Page\imageLinkWithDescription($title,
            $group['description'], "../$groupKey/", 'generic');
    }

    foreach ($group['methods'] as $name => $description) {
        $methodKey = "$groupKey/$name";
        if (strpos($methodKey, $lowerKeyword) !== false) {
            $title = preg_replace($regex, $replace, $methodKey);
            $href = "../$groupKey/$name";
            $items[] = Page\imageLinkWithDescription($title,
                $description, $href, 'generic');
        }
    }

    if (array_key_exists('subgroups', $group)) {
        foreach ($group['subgroups'] as $subgroupKey => $subgroup) {

            $subgroupKey = "$groupKey/$subgroupKey";
            if (strpos($subgroupKey, $lowerKeyword) !== false) {
                $title = preg_replace($regex, $replace, $subgroupKey);
                $href = "../$groupKey/$subgroupKey";
                $items[] = Page\imageLinkWithDescription($title,
                    $subgroup['description'], $href, 'generic');
            }

            foreach ($subgroup['methods'] as $name => $description) {
                $methodKey = "$subgroupKey/$name";
                if (strpos($methodKey, $lowerKeyword) !== false) {
                    $title = preg_replace($regex, $replace, $methodKey);
                    $href = "../$subgroupKey/$name";
                    $items[] = Page\imageLinkWithDescription($title,
                        $description, $href, 'generic');
                }
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
