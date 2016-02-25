<?php

include_once '../../../lib/defaults.php';

include_once '../fns/require_folder.php';
include_once '../../lib/mysqli.php';
list($folder, $id_folders, $user) = require_folder($mysqli);

$fnsDir = '../../fns';

include_once "$fnsDir/request_strings.php";
list($parent_id) = request_strings('parent_id');

$parentFolder = null;
$parent_id = abs((int)$parent_id);
if ($parent_id) {

    include_once "$fnsDir/Users/Folders/get.php";
    $parentFolder = Users\Folders\get($mysqli, $user, $parent_id);

    if (!$parentFolder) {
        include_once "$fnsDir/redirect.php";
        redirect("./?id_folders=$id_folders");
    }

}

include_once "$fnsDir/Folders/indexInUserFolder.php";
$folders = Folders\indexInUserFolder($mysqli, $user->id_users, $parent_id);

include_once "$fnsDir/Page/imageLink.php";

$items = [];
if ($folders) {
    foreach ($folders as $itemFolder) {
        $itemId = $itemFolder->id_folders;
        $escapedName = htmlspecialchars($itemFolder->name);
        if ($itemId == $id_folders) {
            include_once "$fnsDir/Page/disabledImageLink.php";
            $items[] = Page\disabledImageLink($escapedName, 'folder');
        } else {
            $href = "./?id_folders=$id_folders&amp;parent_id=$itemId";
            $items[] = Page\imageLink($escapedName,
                $href, 'folder', ['id' => $itemId]);
        }
    }
} else {
    include_once "$fnsDir/Page/info.php";
    $items[] = Page\info('No subfolders');
}

if ($parent_id != $folder->parent_id) {
    $href = "submit.php?id_folders=$id_folders&amp;parent_id=$parent_id";
    $items[] = Page\imageLink('Move Here', $href, 'move-folder');
}

$key = 'files/move-folder/parent_id';
if (array_key_exists($key, $_SESSION) && $parent_id != $_SESSION[$key]) {
    unset($_SESSION['files/move-folder/errors']);
}

unset(
    $_SESSION['files/errors'],
    $_SESSION['files/id_folders'],
    $_SESSION['files/messages']
);

include_once 'fns/create_content.php';
$content = create_content($mysqli, $folder, $parentFolder, $items);

include_once "$fnsDir/echo_user_page.php";
echo_user_page($user, "Move Folder #$id_folders", $content, '../../');
