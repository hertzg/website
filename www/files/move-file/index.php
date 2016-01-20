<?php

function create_href ($id, $id_folders) {
    if ($id_folders) return "./?id=$id&id_folders=$id_folders";
    return "./?id=$id";
}

include_once '../fns/require_file.php';
include_once '../../lib/mysqli.php';
list($file, $id, $user) = require_file($mysqli);

$fnsDir = '../../fns';

include_once "$fnsDir/request_strings.php";
list($id_folders) = request_strings('id_folders');

$parentFolder = null;
$id_folders = abs((int)$id_folders);
if ($id_folders) {

    include_once "$fnsDir/Users/Folders/get.php";
    $parentFolder = Users\Folders\get($mysqli, $user, $id_folders);

    if (!$parentFolder) {
        include_once "$fnsDir/redirect.php";
        redirect("./?id=$id");
    }

}

include_once "$fnsDir/Users/Folders/index.php";
$folders = Users\Folders\index($mysqli, $user, $id_folders);

include_once "$fnsDir/Page/imageLink.php";

$items = [];
if ($folders) {
    foreach ($folders as $folder) {
        $title = htmlspecialchars($folder->name);
        $href = create_href($id, $folder->id_folders);
        $items[] = Page\imageLink($title, $href,
            'folder', ['id' => $folder->id_folders]);
    }
} else {
    include_once "$fnsDir/Page/info.php";
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

unset(
    $_SESSION['files/view-file/errors'],
    $_SESSION['files/view-file/messages']
);

include_once '../fns/create_move_location_bar.php';
include_once "$fnsDir/Page/create.php";
include_once "$fnsDir/Page/sessionErrors.php";
include_once "$fnsDir/Page/text.php";
$content = Page\create(
    [
        'title' => "File #$id",
        'href' => "../view-file/?id=$id#move",
    ],
    'Move',
    Page\sessionErrors('files/move-file/errors')
    .Page\text(
        'Moving the file "<b>'.htmlspecialchars($file->name).'</b>".'
        .'<br />Select a folder to move the file into:'
    )
    .create_move_location_bar($mysqli, $id, $parentFolder, 'id', 'id_folders')
    .join('<div class="hr"></div>', $items)
);

include_once "$fnsDir/echo_user_page.php";
echo_user_page($user, "Move File #$id", $content, '../../');
