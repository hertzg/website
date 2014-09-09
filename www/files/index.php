<?php

include_once 'fns/require_optional_folder.php';
include_once '../lib/mysqli.php';
list($user, $folder, $id_folders) = require_optional_folder($mysqli, './');
$id_users = $user->id_users;

$items = [];

include_once '../fns/Folders/indexInUserFolder.php';
$folders = Folders\indexInUserFolder($mysqli, $id_users, $id_folders);

include_once '../fns/Files/indexInUserFolder.php';
$files = Files\indexInUserFolder($mysqli, $id_users, $id_folders);

if (count($files) + count($folders) > 1) {

    include_once '../fns/SearchForm/emptyContent.php';
    $formContent = SearchForm\emptyContent('Search folders and files...');
    if ($id_folders) {
        include_once '../fns/Form/hidden.php';
        $formContent = Form\hidden('id_folders', $id_folders).$formContent;
    }

    include_once '../fns/SearchForm/create.php';
    $items[] = SearchForm\create('search/', $formContent);

}

include_once 'fns/render_folders_and_files.php';
render_folders_and_files($folders, $files, $items);

include_once 'fns/unset_session_vars.php';
unset_session_vars();

$key = 'files/id_folders';
if (array_key_exists($key, $_SESSION) && $id_folders != $_SESSION[$key]) {
    unset(
        $_SESSION['files/errors'],
        $_SESSION['files/messages']
    );
}

include_once 'fns/create_options_panel.php';
include_once 'fns/create_location_bar.php';
include_once '../fns/Page/tabs.php';
include_once '../fns/Page/sessionErrors.php';
include_once '../fns/Page/sessionMessages.php';
$content =
    Page\tabs(
        [
            [
                'title' => 'Home',
                'href' => '../home/',
            ],
        ],
        'Files',
        Page\sessionErrors('files/errors')
        .Page\sessionMessages('files/messages')
        .create_location_bar($mysqli, $folder)
        .join('<div class="hr"></div>', $items)
    )
    .create_options_panel($user, $id_folders, $files);

if ($id_folders) {
    include_once 'fns/create_folder_options_panel.php';
    $content .= create_folder_options_panel($id_folders);
}

include_once '../fns/echo_page.php';
echo_page($user, 'Files', $content, '../');
