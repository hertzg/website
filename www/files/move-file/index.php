<?php

function create_link ($id, $idfolders) {
    if ($idfolders) return "./?id=$id&idfolders=$idfolders";
    return "./?id=$id";
}

include_once '../fns/require_file.php';
include_once '../../lib/mysqli.php';
list($file, $id, $user) = require_file($mysqli);
$idusers = $user->idusers;

include_once '../../fns/request_strings.php';
list($idfolders) = request_strings('idfolders');

$idfolders = abs((int)$idfolders);
if ($idfolders) {

    include_once '../../fns/Folders/get.php';
    $parentFolder = Folders\get($mysqli, $idusers, $idfolders);

    if (!$parentFolder) {
        include_once '../../fns/redirect.php';
        redirect("move-file.php?id=$id");
    }

}

include_once '../../fns/Folders/indexInUserFolder.php';
$folders = Folders\indexInUserFolder($mysqli, $idusers, $idfolders);

include_once '../../fns/Page/imageArrowLink.php';
include_once '../../fns/Page/imageLink.php';

$items = array();
if ($idfolders) {
    $items[] = Page\imageLink('.. Parent folder',
        create_link($id, $parentFolder->parentidfolders), 'parent-folder');
}
foreach ($folders as $folder) {
    $items[] = Page\imageArrowLink(htmlspecialchars($folder->foldername),
        create_link($id, $folder->idfolders), 'folder');
}

if ($idfolders != $file->idfolders) {
    $items[] = Page\imageLink('Move Here',
        "submit.php?id=$id&idfolders=$idfolders", 'move-file');
}

if (array_key_exists('files/move-file/index_idfolders', $_SESSION) &&
    $idfolders != $_SESSION['files/move-file/index_idfolders']) {
    unset($_SESSION['files/move-file/index_errors']);
}

unset($_SESSION['files/view-file/index_messages']);

include_once '../fns/create_folder_link.php';
include_once '../../fns/create_tabs.php';
include_once '../../fns/Page/warnings.php';
include_once '../../fns/Page/sessionErrors.php';
$content =
    create_tabs(
        array(
            array(
                'title' => '&middot;&middot;&middot;',
                'href' => create_folder_link($file->idfolders, '../'),
            ),
            array(
                'title' => "File #$id",
                'href' => "../view-file/?id=$file->idfiles",
            ),
        ),
        'Move',
        Page\sessionErrors('files/move-file/index_errors')
        .Page\warnings(array(
            'Moving the file "<b>'.htmlspecialchars($file->filename).'</b>".',
            'Select a folder to move the file into.',
        ))
        .join('<div class="hr"></div>', $items)
    );

include_once '../../fns/echo_page.php';
echo_page($user, "Move File #$id", $content, '../../');
