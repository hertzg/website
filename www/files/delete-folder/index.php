<?php

include_once '../fns/require_folder.php';
include_once '../../lib/mysqli.php';
list($folder, $id_folders, $user) = require_folder($mysqli);

unset(
    $_SESSION['files/errors'],
    $_SESSION['files/id_folders'],
    $_SESSION['files/messages']
);

include_once '../../fns/Page/imageLink.php';
$href = "submit.php?id_folders=$id_folders";
$yesLink = Page\imageLink('Yes, delete folder', $href, 'yes');

$href = "../?id_folders=$id_folders";
$noLink = Page\imageLink('No, return back', $href, 'no');

include_once '../../fns/Page/tabs.php';
include_once '../../fns/Page/text.php';
include_once '../../fns/Page/twoColumns.php';
$content = Page\tabs(
    [
        [
            'title' => 'Home',
            'href' => '../../home/',
        ],
    ],
    'Files',
    Page\text(
        'Are you sure you want to delete the folder'
        .' "<b>'.htmlspecialchars($folder->name).'</b>"?'
    )
    .'<div class="hr"></div>'
    .Page\twoColumns($yesLink, $noLink)
);

include_once '../../fns/echo_page.php';
echo_page($user, "Delete Folder #$id_folders?", $content, '../../');
