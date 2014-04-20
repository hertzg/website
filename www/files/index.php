<?php

$base = '../';

include_once '../fns/require_user.php';
$user = require_user($base);
$id_users = $user->id_users;

include_once '../lib/mysqli.php';

include_once '../fns/request_strings.php';
list($id_folders) = request_strings('id_folders');

$id_folders = abs((int)$id_folders);
if ($id_folders) {
    include_once '../fns/Folders/get.php';
    $folder = Folders\get($mysqli, $id_users, $id_folders);
    if (!$folder) {
        include_once '../fns/redirect.php';
        redirect();
    }
}

$items = [];

include_once '../fns/Folders/indexInUserFolder.php';
$folders = Folders\indexInUserFolder($mysqli, $id_users, $id_folders);

include_once '../fns/Files/indexInUserFolder.php';
$files = Files\indexInUserFolder($mysqli, $id_users, $id_folders);

if (count($files) + count($folders) > 1) {

    include_once '../fns/SearchForm/emptyContent.php';
    $formContent = SearchForm\emptyContent('Search folders and files...');
    if ($id_folders) {
        $formContent =
            "<input type=\"hidden\" name=\"id_folders\" value=\"$id_folders\" />"
            .$formContent;
    }

    include_once '../fns/SearchForm/create.php';
    $items[] = SearchForm\create('search/', $formContent);

}

if ($id_folders) {

    include_once '../fns/create_folder_link.php';
    $href = create_folder_link($folder->parent_id_folders);

    include_once '../fns/Page/imageLink.php';
    $items[] = Page\imageLink('.. Parent folder', $href, 'parent-folder');

}

include_once 'fns/render_folders_and_files.php';
render_folders_and_files($folders, $files, $items, 'Folder is empty');

include_once 'fns/unset_session_vars.php';
unset_session_vars();

$key = 'files/id_folders';
if (array_key_exists($key, $_SESSION) && $id_folders != $_SESSION[$key]) {
    unset($_SESSION['files/messages']);
}

include_once 'fns/create_options_panel.php';
include_once '../fns/Page/tabs.php';
include_once '../fns/Page/sessionMessages.php';
$content =
    create_tabs(
        [
            [
                'title' => 'Home',
                'href' => '../home/',
            ],
        ],
        'Files',
        Page\sessionMessages('files/messages')
        .join('<div class="hr"></div>', $items)
    )
    .create_options_panel($user, $id_folders);

include_once '../fns/echo_page.php';
echo_page($user, 'Files', $content, $base);
