<?php

function create_link ($idfolders, $parentidfolders) {
    if ($parentidfolders) {
        return "move-folder.php?idfolders=$idfolders&parentidfolders=$parentidfolders";
    }
    return "move-folder.php?idfolders=$idfolders";
}

include_once 'lib/require-folder.php';
include_once 'fns/create_folder_link.php';
include_once '../lib/mysqli.php';
include_once '../lib/page.php';

include_once '../fns/request_strings.php';
list($parentidfolders) = request_strings('parentidfolders');

$parentidfolders = abs((int)$parentidfolders);
if ($parentidfolders) {

    include_once '../fns/Folders/get.php';
    $parentFolder = Folders\get($mysqli, $idusers, $parentidfolders);

    if (!$parentFolder) {
        include_once '../fns/redirect.php';
        redirect("move-folder.php?idfolders=$idfolders");
    }

}

include_once '../fns/Folders/index.php';
$folders = Folders\index($mysqli, $idusers, $parentidfolders);

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

unset(
    $_SESSION['files/index_idfolders'],
    $_SESSION['files/index_messages']
);

include_once '../fns/create_tabs.php';

$page->base = '../';
$page->title = "Move Folder #$idfolders";
$page->finish(
    create_tabs(
        array(
            array(
                'title' => '&middot;&middot;&middot;',
                'href' => '..',
            ),
            array(
                'title' => 'Files',
                'href' => create_folder_link($idfolders),
            )
        ),
        'Move',
        $pageErrors
        .Page::warnings(array(
            'Moving the folder "<b>'.htmlspecialchars($folder->foldername).'</b>".',
            'Select a folder to move the folder into.'
        ))
        .join(Page::HR, $items)
    )
);
