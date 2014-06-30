<?php

function create_href ($id, $id_folders) {
    if ($id_folders) return "./?id=$id&id_folders=$id_folders";
    return "./?id=$id";
}

include_once '../fns/require_file.php';
include_once '../../lib/mysqli.php';
list($file, $id, $user) = require_file($mysqli);
$id_users = $user->id_users;

include_once '../../fns/request_strings.php';
list($id_folders) = request_strings('id_folders');

$id_folders = abs((int)$id_folders);
if ($id_folders) {

    include_once '../../fns/Folders/get.php';
    $parentFolder = Folders\get($mysqli, $id_users, $id_folders);

    if (!$parentFolder) {
        include_once '../../fns/redirect.php';
        redirect("./?id=$id");
    }

}

include_once '../../fns/Folders/indexInUserFolder.php';
$folders = Folders\indexInUserFolder($mysqli, $id_users, $id_folders);

include_once '../../fns/Page/imageArrowLink.php';
include_once '../../fns/Page/imageLink.php';

$items = [];
if ($id_folders) {
    $title = '.. Parent folder';
    $href = create_href($id, $parentFolder->parent_id_folders);
    $items[] = Page\imageLink($title, $href, 'parent-folder');
}
if ($folders) {
    foreach ($folders as $folder) {
        $title = htmlspecialchars($folder->name);
        $href = create_href($id, $folder->id_folders);
        $items[] = Page\imageArrowLink($title, $href, 'folder');
    }
} else {
    include_once '../../fns/Page/info.php';
    $items[] = Page\info('No subfolders');
}

if ($id_folders != $file->id_folders) {
    $href = "submit.php?id=$id&id_folders=$id_folders";
    $items[] = Page\imageLink('Move Here', $href, 'move-file');
}

$key = 'files/move-file/id_folders';
if (array_key_exists($key, $_SESSION) && $id_folders != $_SESSION[$key]) {
    unset($_SESSION['files/move-file/errors']);
}

unset($_SESSION['files/view-file/messages']);

include_once '../../fns/create_folder_link.php';
include_once '../../fns/Page/tabs.php';
include_once '../../fns/Page/warnings.php';
include_once '../../fns/Page/sessionErrors.php';
$content = Page\tabs(
    [
        [
            'title' => '&middot;&middot;&middot;',
            'href' => create_folder_link($file->id_folders, '../'),
        ],
        [
            'title' => "File #$id",
            'href' => "../view-file/?id=$file->id_files",
        ],
    ],
    'Move',
    Page\sessionErrors('files/move-file/errors')
    .Page\warnings([
        'Moving the file "<b>'.htmlspecialchars($file->name).'</b>".',
        'Select a folder to move the file into.',
    ])
    .join('<div class="hr"></div>', $items)
);

include_once '../../fns/echo_page.php';
echo_page($user, "Move File #$id", $content, '../../');
