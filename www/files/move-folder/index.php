<?php

include_once '../fns/require_folder.php';
include_once '../../lib/mysqli.php';
list($folder, $id_folders, $user) = require_folder($mysqli);
$id_users = $user->id_users;

$fnsDir = '../../fns';

include_once "$fnsDir/request_strings.php";
list($parent_id_folders) = request_strings('parent_id_folders');

$parentFolder = null;
$parent_id_folders = abs((int)$parent_id_folders);
if ($parent_id_folders) {

    include_once "$fnsDir/Folders/getOnUser.php";
    $parentFolder = Folders\getOnUser($mysqli, $id_users, $parent_id_folders);

    if (!$parentFolder) {
        include_once "$fnsDir/redirect.php";
        redirect("./?id_folders=$id_folders");
    }

}

include_once "$fnsDir/Folders/indexInUserFolder.php";
$folders = Folders\indexInUserFolder($mysqli, $id_users, $parent_id_folders);

include_once "$fnsDir/Page/imageArrowLink.php";

$items = [];
if ($folders) {
    foreach ($folders as $itemFolder) {
        $itemId = $itemFolder->id_folders;
        $escapedName = htmlspecialchars($itemFolder->name);
        if ($itemId == $id_folders) {
            include_once "$fnsDir/Page/disabledImageLink.php";
            $items[] = Page\disabledImageLink($escapedName, 'folder');
        } else {
            $href = "./?id_folders=$id_folders&amp;parent_id_folders=$itemId";
            $items[] = Page\imageArrowLink($escapedName,
                $href, 'folder', ['id' => $itemId]);
        }
    }
} else {
    include_once "$fnsDir/Page/info.php";
    $items[] = Page\info('No subfolders');
}

if ($parent_id_folders != $folder->parent_id_folders) {
    $parentParam = "parent_id_folders=$parent_id_folders";
    $href = "submit.php?id_folders=$id_folders&amp;$parentParam";
    include_once "$fnsDir/Page/imageLink.php";
    $items[] = Page\imageLink('Move Here', $href, 'move-folder');
}

$key = 'files/move-folder/parent_id_folders';
if (array_key_exists($key, $_SESSION) &&
    $parent_id_folders != $_SESSION[$key]) {

    unset($_SESSION['files/move-folder/errors']);

}

unset(
    $_SESSION['files/errors'],
    $_SESSION['files/id_folders'],
    $_SESSION['files/messages']
);

include_once 'fns/create_content.php';
$content = create_content($mysqli, $folder, $parentFolder, $items);

include_once "$fnsDir/echo_page.php";
echo_page($user, "Move Folder #$id_folders", $content, '../../');
