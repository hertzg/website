<?php

include_once '../fns/require_folder.php';
include_once '../../lib/mysqli.php';
list($folder, $id_folders, $user) = require_folder($mysqli);

$key = 'files/rename-folder/values';
if (array_key_exists($key, $_SESSION)) $values = $_SESSION[$key];
else $values = ['name' => $folder->name];

unset(
    $_SESSION['files/errors'],
    $_SESSION['files/id_folders'],
    $_SESSION['files/messages']
);

$fnsDir = '../../fns';

include_once '../fns/create_folder_form_items.php';
include_once "$fnsDir/create_folder_link.php";
include_once "$fnsDir/Form/button.php";
include_once "$fnsDir/Page/sessionErrors.php";
include_once "$fnsDir/Page/staticTwoColumns.php";
include_once "$fnsDir/Page/tabs.php";
$content = Page\tabs(
    [
        [
            'title' => 'Files',
            'href' => create_folder_link($id_folders, '../').'#rename',
        ],
    ],
    "Rename Folder #$id_folders",
    Page\sessionErrors('files/rename-folder/errors')
    .'<form action="submit.php" method="post">'
        .create_folder_form_items($values)
        .'<div class="hr"></div>'
        .Page\staticTwoColumns(
            Form\button('Rename'),
            Form\button('Send', 'sendButton')
        )
        ."<input type=\"hidden\" name=\"id_folders\" value=\"$id_folders\" />"
    .'</form>'
);

include_once "$fnsDir/echo_user_page.php";
echo_user_page($user, "Rename Folder #$id_folders", $content, '../../');
