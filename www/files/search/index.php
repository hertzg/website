<?php

$base = '../../';
$fnsDir = '../../fns';

include_once '../fns/require_optional_folder.php';
include_once '../../lib/mysqli.php';
list($user, $folder, $id_folders) = require_optional_folder($mysqli, '../');
$id_users = $user->id_users;

include_once "$fnsDir/request_strings.php";
list($keyword, $deep) = request_strings('keyword', 'deep');

$deep = (bool)$deep;

$items = [];

include_once "$fnsDir/str_collapse_spaces.php";
$keyword = str_collapse_spaces($keyword);

if ($keyword === '') {
    include_once "$fnsDir/create_folder_link.php";
    include_once "$fnsDir/redirect.php";
    redirect(create_folder_link($id_folders, '../'));
}

if ($deep) {
    include_once '../fns/search_recursively.php';
    list($folders, $files) = search_recursively($mysqli, $id_users,
        $id_folders, $keyword);
} else {

    include_once "$fnsDir/Folders/searchInFolder.php";
    $folders = Folders\searchInFolder($mysqli,
        $id_users, $id_folders, $keyword);

    include_once "$fnsDir/Files/searchInFolder.php";
    $files = Files\searchInFolder($mysqli, $id_users, $id_folders, $keyword);

}

include_once 'fns/create_search_form.php';
$items[] = create_search_form($id_folders, $keyword, $deep);

include_once 'fns/render_folders_and_files.php';
render_folders_and_files($folders, $files, $items, $keyword);

if (!$deep) {

    $params = [];
    if ($id_folders) $params['id_folders'] = $id_folders;
    $params['keyword'] = $keyword;
    $params['deep'] = '1';
    $href = htmlspecialchars('./?'.http_build_query($params));

    include_once "$fnsDir/Page/imageLink.php";
    $items[] = Page\imageLink('Search in Subfolders', $href, 'search-folder');

}

include_once '../fns/unset_session_vars.php';
unset_session_vars();

include_once "$fnsDir/compressed_js_script.php";
include_once "$fnsDir/Page/tabs.php";
$content =
    Page\tabs(
        [
            [
                'title' => 'Home',
                'href' => '../../home/#files',
            ],
        ],
        'Files',
        join('<div class="hr"></div>', $items)
    )
    .compressed_js_script('searchForm', $base);

include_once "$fnsDir/echo_page.php";
echo_page($user, 'Files', $content, $base);
