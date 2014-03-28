<?php

include_once '../fns/require_folder.php';
include_once '../../lib/mysqli.php';
list($folder, $idfolders, $user) = require_folder($mysqli);

unset(
    $_SESSION['files/idfolders'],
    $_SESSION['files/messages']
);

include_once '../../fns/create_folder_link.php';
include_once '../../fns/create_tabs.php';
include_once '../../fns/Page/imageLink.php';
include_once '../../fns/Page/text.php';
$content =
    create_tabs(
        [
            [
                'title' => 'Home',
                'href' => '../../home/',
            ],
        ],
        'Files',
        Page\text(
            'Are you sure you want to delete the folder'
            .' "<b>'.htmlspecialchars($folder->foldername).'</b>"?'
        )
        .'<div class="hr"></div>'
        .Page\imageLink('Yes, delete folder',
            "submit.php?idfolders=$idfolders", 'yes')
        .'<div class="hr"></div>'
        .Page\imageLink('No, return back',
            create_folder_link($idfolders, '../'), 'no')
    );

include_once '../../fns/echo_page.php';
echo_page($user, "Delete Folder #$idfolders?", $content, '../../');
