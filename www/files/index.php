<?php

function create_form ($content) {
    return "<form action=\"./\" style=\"position: relative; height: 48px\">$content</form>";
}

include_once 'lib/require-user.php';
include_once '../fns/request_strings.php';
include_once '../classes/Folders.php';

list($idfolders, $keyword) = request_strings('idfolders', 'keyword');

$idfolders = abs((int)$idfolders);
if ($idfolders) {
    $folder = Folders::get($idusers, $idfolders);
    if (!$folder) {
        include_once '../fns/redirect.php';
        redirect();
    }
}

include_once 'fns/create_folder_link.php';
include_once '../fns/create_panel.php';
include_once '../fns/str_collapse_spaces.php';
include_once '../classes/Files.php';
include_once '../classes/Tab.php';
include_once '../lib/page.php';

$items = array();

$placeholder = 'Search folders and files...';
$keyword = str_collapse_spaces($keyword);
if ($keyword === '') {

    $folders = Folders::index($idusers, $idfolders);
    $files = Files::index($idusers, $idfolders);

    include_once '../fns/create_search_form_empty_content.php';
    $content = create_search_form_empty_content($placeholder);
    if ($idfolders) {
        $content =
            "<input type=\"hidden\" name=\"idfolders\" value=\"$idfolders\" />"
            .$content;
    }
    $items[] = create_form($content);

} else {

    $folders = Folders::search($idusers, $idfolders, $keyword);
    $files = Files::search($idusers, $idfolders, $keyword);

    $clearHref = create_folder_link($idfolders);
    include_once '../fns/create_search_form_content.php';
    $content = create_search_form_content($keyword, $placeholder, $clearHref);
    if ($idfolders) {
        $content =
            "<input type=\"hidden\" name=\"idfolders\" value=\"$idfolders\" />"
            .$content;
    }
    $items[] = create_form($content);

}

if ($idfolders) {
    $items[] = Page::imageLink(
        '.. Parent folder',
        create_folder_link($folder->parentidfolders),
        'parent-folder'
    );
}

if ($folders || $files) {

    foreach ($folders as $i => $folder) {
        $items[] = Page::imageLink(
            htmlspecialchars($folder->foldername),
            create_folder_link($folder->idfolders),
            'folder'
        );
    }

    foreach ($files as $i => $file) {
        $items[] = Page::imageLink(
            htmlspecialchars($file->filename),
            "view/?id=$file->idfiles",
            'file'
        );
    }

} else {
    if ($keyword === '') $text = 'Folder is empty.';
    else $text = 'Nothing found.';
    $items[] = Page::info($text);
}

unset(
    $_SESSION['files/add-folder_errors'],
    $_SESSION['files/add-folder_lastpost'],
    $_SESSION['files/rename-folder_errors'],
    $_SESSION['files/rename-folder_lastpost'],
    $_SESSION['files/upload-files_errors'],
    $_SESSION['files/view/index_messages'],
    $_SESSION['home/index_messages']
);

if (array_key_exists('files/index_idfolders', $_SESSION) &&
    $idfolders != $_SESSION['files/index_idfolders']) {
    unset($_SESSION['files/index_messages']);
}

$folder_options = '';
if ($idfolders) {
    $folder_options =
        Page::HR
        .Page::imageLink(
            'Rename This Folder',
            "rename-folder.php?idfolders=$idfolders",
            'rename'
        )
        .Page::HR
        .Page::imageLink(
            'Move This Folder',
            "move-folder.php?idfolders=$idfolders",
            'move-folder'
        )
        .Page::HR
        .Page::imageLink(
            'Delete This Folder',
            "delete-folder.php?idfolders=$idfolders",
            'trash-bin'
        );
}

if (array_key_exists('files/index_messages', $_SESSION)) {
    $pageMessages = Page::messages($_SESSION['files/index_messages']);
} else {
    $pageMessages = '';
}

$page->base = '../';
$page->title = 'Files';
$page->finish(
    Tab::create(
        Tab::activeItem('Files'),
        $pageMessages
        .join(Page::HR, $items)
    )
    .create_panel(
        'Options',
        Page::imageLink(
            'New Folder',
            "add-folder.php?parentidfolders=$idfolders",
            'create-folder'
        )
        .Page::HR
        .Page::imageLink(
            'Upload Files',
            "upload-files.php?idfolders=$idfolders",
            'upload'
        )
        .$folder_options
    )
);
