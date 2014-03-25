<?php

$base = '../../';

include_once '../../fns/require_user.php';
$user = require_user($base);
$idusers = $user->idusers;

include_once '../../lib/mysqli.php';

include_once '../../fns/request_strings.php';
list($idfolders, $keyword, $deep) = request_strings(
    'idfolders', 'keyword', 'deep');

$idfolders = abs((int)$idfolders);
if ($idfolders) {
    include_once '../../fns/Folders/get.php';
    $folder = Folders\get($mysqli, $idusers, $idfolders);
    if (!$folder) {
        include_once '../../fns/redirect.php';
        redirect();
    }
}

$deep = (bool)$deep;

$items = array();

include_once '../../fns/str_collapse_spaces.php';
$keyword = str_collapse_spaces($keyword);

if ($keyword === '') {
    include_once '../../fns/create_folder_link.php';
    include_once '../../fns/redirect.php';
    redirect(create_folder_link($idfolders, '../'));
}

if ($deep) {
    include_once '../fns/search_recursively.php';
    list($folders, $files) = search_recursively($mysqli, $idusers, $idfolders, $keyword);
} else {

    include_once '../../fns/Folders/searchInFolder.php';
    $folders = Folders\searchInFolder($mysqli, $idusers, $idfolders, $keyword);

    include_once '../../fns/Files/searchInFolder.php';
    $files = Files\searchInFolder($mysqli, $idusers, $idfolders, $keyword);

}

include_once 'fns/create_search_form.php';
$items[] = create_search_form($idfolders, $keyword, $deep);

include_once '../fns/render_folders_and_files.php';
render_folders_and_files($folders, $files, $items, 'No files found.', '../');

if (!$deep) {

    $params = array();
    if ($idfolders) $params['idfolders'] = $idfolders;
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
        array(
            array(
                'title' => 'Home',
                'href' => '../../home/',
            ),
        ),
        'Files',
        join('<div class="hr"></div>', $items)
    )
    .create_options_panel($idfolders, '../');

include_once '../../fns/echo_page.php';
echo_page($user, 'Files', $content, $base);
