<?php

$base = '../';

include_once '../fns/require_user.php';
$user = require_user($base);
$idusers = $user->idusers;

include_once '../lib/mysqli.php';

include_once '../fns/request_strings.php';
list($idfolders) = request_strings('idfolders');

$idfolders = abs((int)$idfolders);
if ($idfolders) {
    include_once '../fns/Folders/get.php';
    $folder = Folders\get($mysqli, $idusers, $idfolders);
    if (!$folder) {
        include_once '../fns/redirect.php';
        redirect();
    }
}

$items = array();

include_once '../fns/Folders/indexInUserFolder.php';
$folders = Folders\indexInUserFolder($mysqli, $idusers, $idfolders);

include_once '../fns/Files/indexInUserFolder.php';
$files = Files\indexInUserFolder($mysqli, $idusers, $idfolders);

if (count($files) + count($folders) > 1) {

    include_once '../fns/SearchForm/emptyContent.php';
    $formContent = SearchForm\emptyContent('Search folders and files...');
    if ($idfolders) {
        $formContent =
            "<input type=\"hidden\" name=\"idfolders\" value=\"$idfolders\" />"
            .$formContent;
    }

    include_once '../fns/SearchForm/create.php';
    $items[] = SearchForm\create('search/', $formContent);

}

if ($idfolders) {

    include_once '../fns/create_folder_link.php';
    $href = create_folder_link($folder->parentidfolders);

    include_once '../fns/Page/imageLink.php';
    $items[] = Page\imageLink('.. Parent folder', $href, 'parent-folder');

}

include_once 'fns/render_folders_and_files.php';
render_folders_and_files($folders, $files, $items, 'Folder is empty.');

unset(
    $_SESSION['files/add-folder/errors'],
    $_SESSION['files/add-folder/values'],
    $_SESSION['files/rename-folder/errors'],
    $_SESSION['files/rename-folder/values'],
    $_SESSION['files/upload-files/errors'],
    $_SESSION['files/view-file/messages'],
    $_SESSION['home/messages']
);

if (array_key_exists('files/idfolders', $_SESSION) &&
    $idfolders != $_SESSION['files/idfolders']) {
    unset($_SESSION['files/messages']);
}

include_once 'fns/create_options_panel.php';
include_once '../fns/create_tabs.php';
include_once '../fns/Page/sessionMessages.php';
$content =
    create_tabs(
        array(
            array(
                'title' => 'Home',
                'href' => '../home/',
            ),
        ),
        'Files',
        Page\sessionMessages('files/messages')
        .join('<div class="hr"></div>', $items)
    )
    .create_options_panel($idfolders);

include_once '../fns/echo_page.php';
echo_page($user, 'Files', $content, $base);
