<?php

$base = '../../../';
$fnsDir = '../../../fns';

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

$lowerKeyword = mb_strtolower($keyword, 'UTF-8');
$regex = '/('.preg_quote($lowerKeyword, '/').')+/i';
$replace = '<mark>$1</mark>';

include_once "$fnsDir/SearchForm/content.php";
$searchContent = SearchForm\content($keyword, 'Search page...', '..');

include_once "$fnsDir/SearchForm/create.php";
$items = [SearchForm\create('./', $searchContent)];

include_once 'fns/get_full_groups.php';
$groups = get_full_groups();

$found = false;

include_once "$fnsDir/Page/imageLinkWithDescription.php";
foreach ($groups as $groupKey => $group) {

    if (strpos($groupKey, $lowerKeyword) !== false) {
        $found = true;
        $title = preg_replace($regex, $replace, $groupKey);
        $items[] = Page\imageLinkWithDescription($title,
            $group['description'], "../$groupKey/", 'api-namespace');
    }

    foreach ($group['methods'] as $name => $description) {
        $title = "$groupKey/$name";
        if (strpos($title, $lowerKeyword) !== false) {
            $found = true;
            $title = preg_replace($regex, $replace, $title);
            $href = "../$groupKey/$name/";
            $items[] = Page\imageLinkWithDescription($title,
                $description, $href, 'api-method');
        }
    }

    if (array_key_exists('subgroups', $group)) {
        foreach ($group['subgroups'] as $subgroupKey => $subgroup) {

            $title = "$groupKey/$subgroupKey";
            if (strpos($title, $lowerKeyword) !== false) {
                $found = true;
                $title = preg_replace($regex, $replace, $title);
                $href = "../$groupKey/$subgroupKey/";
                $items[] = Page\imageLinkWithDescription($title,
                    $subgroup['description'], $href, 'api-namespace');
            }

            foreach ($subgroup['methods'] as $name => $description) {
                $title = "$groupKey/$subgroupKey/$name";
                if (strpos($title, $lowerKeyword) !== false) {
                    $found = true;
                    $title = preg_replace($regex, $replace, $title);
                    $href = "../$groupKey/$subgroupKey/$name/";
                    $items[] = Page\imageLinkWithDescription($title,
                        $description, $href, 'api-method');
                }
            }

        }
    }

}

if (!$found) {
    include_once "$fnsDir/Page/info.php";
    $items[] = Page\info('Nothing found');
}

include_once 'fns/create_content.php';
include_once "$fnsDir/compressed_js_script.php";
$content =
    create_content($items)
    .compressed_js_script('searchForm', $base);

include_once "$fnsDir/echo_public_page.php";
echo_public_page($user, 'Search API Documentation', $content, $base);
