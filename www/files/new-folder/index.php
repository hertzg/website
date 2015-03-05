<?php

include_once '../fns/require_parent_folder.php';
include_once '../../lib/mysqli.php';
list($parentFolder, $parent_id, $user) = require_parent_folder($mysqli);

$key = 'files/new-folder/values';
if (array_key_exists($key, $_SESSION)) $values = $_SESSION[$key];
else $values = ['name' => ''];

unset(
    $_SESSION['files/errors'],
    $_SESSION['files/id_folders'],
    $_SESSION['files/messages']
);

include_once '../../fns/create_folder_link.php';
$folder_link = create_folder_link($parent_id, '../');

include_once '../../fns/Folders/maxLengths.php';
include_once '../../fns/Page/tabs.php';
include_once '../../fns/Form/button.php';
include_once '../../fns/Form/hidden.php';
include_once '../../fns/Form/textfield.php';
include_once '../../fns/Page/sessionErrors.php';
$content = Page\tabs(
    [
        [
            'title' => 'Files',
            'href' => "$folder_link#new-folder",
        ],
    ],
    'New Folder',
    Page\sessionErrors('files/new-folder/errors')
    .'<form action="submit.php" method="post">'
        .Form\textfield('name', 'Folder name', [
            'value' => $values['name'],
            'maxlength' => Folders\maxLengths()['name'],
            'autofocus' => true,
            'required' => true,
        ])
        .'<div class="hr"></div>'
        .Form\button('Create')
        .Form\hidden('parent_id', $parent_id)
    .'</form>'
);

include_once '../../fns/echo_page.php';
echo_page($user, 'New Folder', $content, '../../');
