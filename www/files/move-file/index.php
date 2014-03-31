<?php

function create_link ($id, $id_folders) {
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
        redirect("move-file.php?id=$id");
    }

}

include_once '../../fns/Folders/indexInUserFolder.php';
$folders = Folders\indexInUserFolder($mysqli, $id_users, $id_folders);

include_once '../../fns/Page/imageArrowLink.php';
include_once '../../fns/Page/imageLink.php';

$items = [];
if ($id_folders) {
    $items[] = Page\imageLink('.. Parent folder',
        create_link($id, $parentFolder->parent_id_folders), 'parent-folder');
}
foreach ($folders as $folder) {
    $items[] = Page\imageArrowLink(htmlspecialchars($folder->folder_name),
        create_link($id, $folder->id_folders), 'folder');
}

if ($id_folders != $file->id_folders) {
    $items[] = Page\imageLink('Move Here',
        "submit.php?id=$id&id_folders=$id_folders", 'move-file');
}

$key = 'files/move-file/id_folders';
if (array_key_exists($key, $_SESSION) && $id_folders != $_SESSION[$key]) {
    unset($_SESSION['files/move-file/errors']);
}

unset($_SESSION['files/view-file/messages']);

include_once '../../fns/create_folder_link.php';
include_once '../../fns/create_tabs.php';
include_once '../../fns/Page/warnings.php';
include_once '../../fns/Page/sessionErrors.php';
$content =
    create_tabs(
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
            'Moving the file "<b>'.htmlspecialchars($file->file_name).'</b>".',
            'Select a folder to move the file into.',
        ])
        .join('<div class="hr"></div>', $items)
    );

include_once '../../fns/echo_page.php';
echo_page($user, "Move File #$id", $content, '../../');
