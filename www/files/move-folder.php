<?php

function create_link ($idfolders, $parentidfolders) {
    if ($parentidfolders) {
        return "move-folder.php?idfolders=$idfolders&parentidfolders=$parentidfolders";
    }
    return "move-folder.php?idfolders=$idfolders";
}

include_once 'lib/require-folder.php';
include_once 'fns/create_folder_link.php';
include_once '../fns/request_strings.php';
include_once '../classes/Tab.php';
include_once '../lib/page.php';

list($parentidfolders) = request_strings('parentidfolders');

$parentidfolders = abs((int)$parentidfolders);
if ($parentidfolders) {
    $parentFolder = Folders::get($idusers, $parentidfolders);
    if (!$parentFolder) {
        redirect("move-folder.php?idfolders=$idfolders");
    }
}

$folders = Folders::index($idusers, $parentidfolders);

$items = array();
if ($parentidfolders) {
    $items[] = Page::imageLink(
        '.. Parent folder',
        create_link($idfolders, $parentFolder->parentidfolders),
        'parent-folder'
    );
}
foreach ($folders as $itemFolder) {
    $escapedName = htmlspecialchars($itemFolder->foldername);
    if ($itemFolder->idfolders == $idfolders) {
        $items[] = Page::disabledImageLink($escapedName, 'folder');
    } else {
        $items[] = Page::imageLink(
            $escapedName,
            create_link($idfolders, $itemFolder->idfolders),
            'folder'
        );
    }
}

if ($parentidfolders != $folder->parentidfolders) {
    $items[] = Page::imageLink(
        'Move Here',
        "submit-move-folder.php?idfolders=$idfolders&parentidfolders=$parentidfolders",
        'move-folder'
    );
}

if (array_key_exists('files/move-folder_parentidfolders', $_SESSION) &&
    $parentidfolders != $_SESSION['files/move-folder_parentidfolders']) {
    unset($_SESSION['files/move-folder_errors']);
}

if (array_key_exists('files/move-folder_errors', $_SESSION)) {
    $pageErrors = Page::errors($_SESSION['files/move-folder_errors']);
} else {
    $pageErrors = '';
}

$page->base = '../';
$page->title = htmlspecialchars($folder->foldername);
$page->finish(
    Tab::create(
        Tab::item('Files', create_folder_link($idfolders))
        .Tab::activeItem('Move'),
        $pageErrors
        .Page::warnings(array(
            'Moving the folder "<b>'.htmlspecialchars($folder->foldername).'</b>".',
            'Select a folder to move the folder into.'
        ))
        .join(Page::HR, $items)
    )
);
