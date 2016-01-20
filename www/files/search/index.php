<?php

$base = '../../';
$fnsDir = '../../fns';

include_once '../fns/require_optional_folder.php';
include_once '../../lib/mysqli.php';
list($user, $folder, $id_folders) = require_optional_folder($mysqli, '../');

include_once "$fnsDir/request_strings.php";
list($keyword, $deep) = request_strings('keyword', 'deep');

$deep = (bool)$deep;

$items = [];

include_once "$fnsDir/str_collapse_spaces.php";
$keyword = str_collapse_spaces($keyword);

if ($keyword === '') {
    include_once '../fns/create_parent_url.php';
    include_once "$fnsDir/redirect.php";
    redirect(create_parent_url($id_folders, '../'));
}

if ($deep) {
    include_once 'fns/search_recursively.php';
    list($folders, $files) = search_recursively(
        $mysqli, $user, $id_folders, $keyword);
} else {

    include_once "$fnsDir/Users/Folders/searchInFolder.php";
    $folders = Users\Folders\searchInFolder(
        $mysqli, $user, $id_folders, $keyword);

    include_once "$fnsDir/Users/Files/searchInFolder.php";
    $files = Users\Files\searchInFolder($mysqli, $user, $id_folders, $keyword);

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

include_once '../fns/create_tabs.php';
include_once "$fnsDir/Page/create.php";
$content = Page\create(
    [
        'title' => 'Home',
        'href' => '../../search/?keyword='.rawurlencode($keyword),
    ],
    'Files',
    create_tabs($user, '../')
    .join('<div class="hr"></div>', $items)
);

include_once "$fnsDir/compressed_js_script.php";
include_once "$fnsDir/echo_user_page.php";
echo_user_page($user, 'Files', $content, $base, [
    'scripts' => compressed_js_script('searchForm', $base),
]);
