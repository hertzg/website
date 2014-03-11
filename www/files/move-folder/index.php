<?php

function create_link ($idfolders, $parentidfolders) {
    if ($parentidfolders) {
        return "./?idfolders=$idfolders&parentidfolders=$parentidfolders";
    }
    return "./?idfolders=$idfolders";
}

include_once '../fns/require_folder.php';
include_once '../../lib/mysqli.php';
list($folder, $idfolders, $user) = require_folder($mysqli);
$idusers = $user->idusers;

include_once '../../fns/request_strings.php';
list($parentidfolders) = request_strings('parentidfolders');

$parentidfolders = abs((int)$parentidfolders);
if ($parentidfolders) {

    include_once '../../fns/Folders/get.php';
    $parentFolder = Folders\get($mysqli, $idusers, $parentidfolders);

    if (!$parentFolder) {
        include_once '../../fns/redirect.php';
        redirect("./?idfolders=$idfolders");
    }

}

include_once '../../fns/Folders/indexInUserFolder.php';
$folders = Folders\indexInUserFolder($mysqli, $idusers, $parentidfolders);

include_once '../../fns/Page/imageArrowLink.php';
include_once '../../fns/Page/imageLink.php';

$items = array();
if ($parentidfolders) {
    $items[] = Page\imageLink('.. Parent folder',
        create_link($idfolders, $parentFolder->parentidfolders),
        'parent-folder');
}
foreach ($folders as $itemFolder) {
    $escapedName = htmlspecialchars($itemFolder->foldername);
    if ($itemFolder->idfolders == $idfolders) {
        include_once '../../fns/create_disabled_image_link.php';
        $items[] = create_disabled_image_link($escapedName, 'folder');
    } else {
        $items[] = Page\imageArrowLink($escapedName,
            create_link($idfolders, $itemFolder->idfolders), 'folder');
    }
}

if ($parentidfolders != $folder->parentidfolders) {
    $items[] = Page\imageLink('Move Here',
        "submit.php?idfolders=$idfolders&parentidfolders=$parentidfolders",
        'move-folder');
}

if (array_key_exists('files/move-folder_parentidfolders', $_SESSION) &&
    $parentidfolders != $_SESSION['files/move-folder_parentidfolders']) {
    unset($_SESSION['files/move-folder_errors']);
}

unset(
    $_SESSION['files/index_idfolders'],
    $_SESSION['files/index_messages']
);

include_once '../fns/create_folder_link.php';
include_once '../../fns/create_tabs.php';
include_once '../../fns/Page/sessionErrors.php';
include_once '../../fns/Page/warnings.php';
$content =
    create_tabs(
        array(
            array(
                'title' => '&middot;&middot;&middot;',
                'href' => '../..',
            ),
            array(
                'title' => 'Files',
                'href' => create_folder_link($idfolders, '../'),
            )
        ),
        'Move',
        Page\sessionErrors('files/move-folder_errors')
        .Page\warnings(array(
            'Moving the folder "<b>'.htmlspecialchars($folder->foldername).'</b>".',
            'Select a folder to move the folder into.'
        ))
        .join('<div class="hr"></div>', $items)
    );

include_once '../../fns/echo_page.php';
echo_page($user, "Move Folder #$idfolders", $content, '../../');
