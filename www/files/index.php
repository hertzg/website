<?php

function create_form ($content) {
    return "<form action=\"./\" style=\"position: relative; height: 48px\">$content</form>";
}

include_once 'lib/require-user.php';
include_once '../classes/Folders.php';
include_once '../lib/mysqli.php';

include_once '../fns/request_strings.php';
list($idfolders, $keyword, $deep) = request_strings('idfolders', 'keyword', 'deep');

$idfolders = abs((int)$idfolders);
if ($idfolders) {
    include_once '../fns/Folders/get.php';
    $folder = Folders\get($mysqli, $idusers, $idfolders);
    if (!$folder) {
        include_once '../fns/redirect.php';
        redirect();
    }
}

$deep = (bool)$deep;

include_once 'fns/create_folder_link.php';
include_once '../fns/create_panel.php';
include_once '../fns/str_collapse_spaces.php';
include_once '../classes/Files.php';
include_once '../lib/page.php';

$items = array();

$placeholder = 'Search folders and files...';
$keyword = str_collapse_spaces($keyword);
if ($keyword === '') {

    include_once '../fns/Folders/index.php';
    $folders = Folders\index($mysqli, $idusers, $idfolders);

    include_once '../fns/Files/index.php';
    $files = Files\index($mysqli, $idusers, $idfolders);

    include_once '../fns/create_search_form_empty_content.php';
    $content = create_search_form_empty_content($placeholder);
    if ($idfolders) {
        $content =
            "<input type=\"hidden\" name=\"idfolders\" value=\"$idfolders\" />"
            .$content;
    }
    $items[] = create_form($content);

} else {

    if ($deep) {
        include_once 'fns/search_recursively.php';
        list($folders, $files) = search_recursively($mysqli, $idusers, $idfolders, $keyword);
    } else {

        include_once '../fns/Folders/search.php';
        $folders = Folders\search($mysqli, $idusers, $idfolders, $keyword);

        include_once '../fns/Files/search.php';
        $files = Files\search($mysqli, $idusers, $idfolders, $keyword);

    }

    $clearHref = create_folder_link($idfolders);
    include_once '../fns/create_search_form_content.php';
    $content = create_search_form_content($keyword, $placeholder, $clearHref);
    if ($idfolders) {
        $content =
            "<input type=\"hidden\" name=\"idfolders\" value=\"$idfolders\" />"
            .$content;
    }
    if ($deep) {
        $content .= '<input type="hidden" name="deep" value="1" />';
    }
    $items[] = create_form($content);

}

if ($idfolders && $keyword === '') {
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

if ($keyword !== '' && !$deep) {
    $params = array();
    if ($idfolders) $params['idfolders'] = $idfolders;
    $params['keyword'] = $keyword;
    $params['deep'] = '1';
    $href = htmlspecialchars('./?'.http_build_query($params));
    $items[] = Page::imageLink('Search in Subfolders', $href, 'search-folder');
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

include_once '../fns/create_tabs.php';

$page->base = '../';
$page->title = 'Files';
$page->finish(
    create_tabs(
        [
            [
                'title' => 'Home',
                'href' => '..',
            ],
        ],
        'Files',
        $pageMessages.join(Page::HR, $items)
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
