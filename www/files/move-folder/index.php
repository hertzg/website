<?php

function create_href ($id_folders, $parent_id_folders) {
    if ($parent_id_folders) {
        return "./?id_folders=$id_folders&parent_id_folders=$parent_id_folders";
    }
    return "./?id_folders=$id_folders";
}

include_once '../fns/require_folder.php';
include_once '../../lib/mysqli.php';
list($folder, $id_folders, $user) = require_folder($mysqli);
$id_users = $user->id_users;

include_once '../../fns/request_strings.php';
list($parent_id_folders) = request_strings('parent_id_folders');

$parent_id_folders = abs((int)$parent_id_folders);
if ($parent_id_folders) {

    include_once '../../fns/Folders/get.php';
    $parentFolder = Folders\get($mysqli, $id_users, $parent_id_folders);

    if (!$parentFolder) {
        include_once '../../fns/redirect.php';
        redirect("./?id_folders=$id_folders");
    }

}

include_once '../../fns/Folders/indexInUserFolder.php';
$folders = Folders\indexInUserFolder($mysqli, $id_users, $parent_id_folders);

include_once '../../fns/Page/imageArrowLink.php';
include_once '../../fns/Page/imageLink.php';

$items = [];
if ($parent_id_folders) {
    $title = '.. Parent folder';
    $href = create_href($id_folders, $parentFolder->parent_id_folders);
    $items[] = Page\imageLink($title, $href, 'parent-folder');
}
foreach ($folders as $itemFolder) {
    $escapedName = htmlspecialchars($itemFolder->folder_name);
    if ($itemFolder->id_folders == $id_folders) {
        include_once '../../fns/Page/disabledImageLink.php';
        $items[] = Page\disabledImageLink($escapedName, 'folder');
    } else {
        $href = create_href($id_folders, $itemFolder->id_folders);
        $items[] = Page\imageArrowLink($escapedName, $href, 'folder');
    }
}

if ($parent_id_folders != $folder->parent_id_folders) {
    $href = "submit.php?id_folders=$id_folders&parent_id_folders=$parent_id_folders";
    $items[] = Page\imageLink('Move Here', $href, 'move-folder');
}

$key = 'files/move-folder/parent_id_folders';
if (array_key_exists($key, $_SESSION) && $parent_id_folders != $_SESSION[$key]) {
    unset($_SESSION['files/move-folder/errors']);
}

unset(
    $_SESSION['files/id_folders'],
    $_SESSION['files/messages']
);

include_once '../../fns/create_folder_link.php';
include_once '../../fns/Page/tabs.php';
include_once '../../fns/Page/sessionErrors.php';
include_once '../../fns/Page/warnings.php';
$content = Page\tabs(
    [
        [
            'title' => '&middot;&middot;&middot;',
            'href' => '../../home/',
        ],
        [
            'title' => 'Files',
            'href' => create_folder_link($id_folders, '../'),
        ]
    ],
    'Move',
    Page\sessionErrors('files/move-folder/errors')
    .Page\warnings([
        'Moving the folder "<b>'.htmlspecialchars($folder->folder_name).'</b>".',
        'Select a folder to move the folder into.'
    ])
    .join('<div class="hr"></div>', $items)
);

include_once '../../fns/echo_page.php';
echo_page($user, "Move Folder #$id_folders", $content, '../../');
