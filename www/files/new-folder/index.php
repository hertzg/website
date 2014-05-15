<?php

$base = '../../';

include_once '../../fns/require_user.php';
$user = require_user($base);

include_once '../../fns/request_strings.php';
list($parent_id_folders) = request_strings('parent_id_folders');

$key = 'files/new-folder/values';
if (array_key_exists($key, $_SESSION)) {
    $values = $_SESSION[$key];
} else {
    $values = ['folder_name' => ''];
}

$parent_id_folders = abs((int)$parent_id_folders);
if ($parent_id_folders) {

    include_once '../../fns/Folders/get.php';
    include_once '../../lib/mysqli.php';
    $parentFolder = Folders\get($mysqli, $user->id_users, $parent_id_folders);

    if (!$parentFolder) {
        include_once '../../fns/redirect.php';
        redirect('..');
    }

}

unset(
    $_SESSION['files/errors'],
    $_SESSION['files/id_folders'],
    $_SESSION['files/messages']
);

include_once '../../fns/create_folder_link.php';
include_once '../../fns/Page/tabs.php';
include_once '../../fns/Form/button.php';
include_once '../../fns/Form/hidden.php';
include_once '../../fns/Form/textfield.php';
include_once '../../fns/Page/sessionErrors.php';
$content = Page\tabs(
    [
        [
            'title' => '&middot;&middot;&middot;',
            'href' => '../../home/',
        ],
        [
            'title' => 'Files',
            'href' => create_folder_link($parent_id_folders, '../'),
        ],
    ],
    'New Folder',
    Page\sessionErrors('files/new-folder/errors')
    .'<form action="submit.php" method="post">'
        .Form\textfield('folder_name', 'Folder name', [
            'value' => $values['folder_name'],
            'autofocus' => true,
            'required' => true,
        ])
        .'<div class="hr"></div>'
        .Form\button('Create')
        .Form\hidden('parent_id_folders', $parent_id_folders)
    .'</form>'
);

include_once '../../fns/echo_page.php';
echo_page($user, 'New Folder', $content, $base);
