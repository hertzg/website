<?php

$base = '../../';

include_once '../../fns/require_user.php';
$user = require_user($base);
$id_users = $user->id_users;

include_once '../../lib/mysqli.php';

include_once '../../fns/request_strings.php';
list($id_folders, $keyword, $deep) = request_strings(
    'id_folders', 'keyword', 'deep');

$id_folders = abs((int)$id_folders);
if ($id_folders) {
    include_once '../../fns/Folders/get.php';
    $folder = Folders\get($mysqli, $id_users, $id_folders);
    if (!$folder) {
        include_once '../../fns/redirect.php';
        redirect();
    }
}

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
    $folders = Folders\searchInFolder($mysqli, $id_users, $id_folders, $keyword);

    include_once '../../fns/Files/searchInFolder.php';
    $files = Files\searchInFolder($mysqli, $id_users, $id_folders, $keyword);

}

include_once 'fns/create_search_form.php';
$items[] = create_search_form($id_folders, $keyword, $deep);

include_once '../fns/render_folders_and_files.php';
render_folders_and_files($folders, $files, $items, 'No files found', '../');

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

include_once '../fns/create_options_panel.php';
include_once '../../fns/create_tabs.php';
$content =
    create_tabs(
        [
            [
                'title' => 'Home',
                'href' => '../../home/',
            ],
        ],
        'Files',
        join('<div class="hr"></div>', $items)
    )
    .create_options_panel($user, $id_folders, '../');

include_once '../../fns/echo_page.php';
echo_page($user, 'Files', $content, $base);
