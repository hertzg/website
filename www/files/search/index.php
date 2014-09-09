<?php

include_once '../fns/require_optional_folder.php';
include_once '../../lib/mysqli.php';
list($user, $folder, $id_folders) = require_optional_folder($mysqli, '../');
$id_users = $user->id_users;

include_once '../../fns/request_strings.php';
list($keyword, $deep) = request_strings('keyword', 'deep');

$deep = (bool)$deep;

$items = [];

include_once '../../fns/str_collapse_spaces.php';
$keyword = str_collapse_spaces($keyword);

if ($keyword === '') {
    include_once '../../fns/create_folder_link.php';
    include_once '../../fns/redirect.php';
    redirect(create_folder_link($id_folders, '../'));
}

if ($deep) {
    include_once '../fns/search_recursively.php';
    list($folders, $files) = search_recursively($mysqli, $id_users,
        $id_folders, $keyword);
} else {

    include_once '../../fns/Folders/searchInFolder.php';
    $folders = Folders\searchInFolder($mysqli,
        $id_users, $id_folders, $keyword);

    include_once '../../fns/Files/searchInFolder.php';
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

    include_once '../../fns/Page/imageLink.php';
    $items[] = Page\imageLink('Search in Subfolders', $href, 'search-folder');

}

include_once '../fns/unset_session_vars.php';
unset_session_vars();

include_once '../../fns/Page/tabs.php';
$content = Page\tabs(
    [
        [
            'title' => 'Home',
            'href' => '../../home/',
        ],
    ],
    'Files',
    join('<div class="hr"></div>', $items)
);

include_once '../../fns/echo_page.php';
echo_page($user, 'Files', $content, '../../');
