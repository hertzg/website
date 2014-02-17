<?php

function create_link ($id, $idfolders) {
    if ($idfolders) {
        return "move-file.php?id=$id&idfolders=$idfolders";
    }
    return "move-file.php?id=$id";
}

include_once 'lib/require-file.php';
include_once 'fns/create_folder_link.php';
include_once '../lib/mysqli.php';
include_once '../lib/page.php';

include_once '../fns/request_strings.php';
list($idfolders) = request_strings('idfolders');

$idfolders = abs((int)$idfolders);
if ($idfolders) {

    include_once '../fns/Folders/get.php';
    $parentFolder = Folders\get($mysqli, $idusers, $idfolders);

    if (!$parentFolder) {
        include_once '../fns/redirect.php';
        redirect("move-file.php?id=$id");
    }

}

include_once '../fns/Folders/index.php';
$folders = Folders\index($mysqli, $idusers, $idfolders);

$items = array();
if ($idfolders) {
    $items[] = Page::imageLink(
        '.. Parent folder',
        create_link($id, $parentFolder->parentidfolders),
        'parent-folder'
    );
}
foreach ($folders as $folder) {
    $items[] = Page::imageLink(
        htmlspecialchars($folder->foldername),
        create_link($id, $folder->idfolders),
        'folder'
    );
}

if ($idfolders != $file->idfolders) {
    $items[] = Page::imageLink(
        'Move Here',
        "submit-move-file.php?id=$id&idfolders=$idfolders",
        'move-file'
    );
}

if (array_key_exists('files/move-file_idfolders', $_SESSION) &&
    $idfolders != $_SESSION['files/move-file_idfolders']) {
    unset($_SESSION['files/move-file_errors']);
}

if (array_key_exists('files/move-file_errors', $_SESSION)) {
    $pageErrors = Page::errors($_SESSION['files/move-file_errors']);
} else {
    $pageErrors = '';
}

unset($_SESSION['files/view/index_messages']);

include_once '../fns/create_tabs.php';

$page->base = '../';
$page->title = "Move File #$id";
$page->finish(
    create_tabs(
        [
            [
                'title' => '&middot;&middot;&middot;',
                'href' => create_folder_link($file->idfolders),
            ],
            [
                'title' => "File #$id",
                'href' => "view/?id=$file->idfiles",
            ],
        ],
        'Move',
        $pageErrors
        .Page::warnings(array(
            'Moving the file "<b>'.htmlspecialchars($file->filename).'</b>".',
            'Select a folder to move the file into.',
        ))
        .join(Page::HR, $items)
    )
);
