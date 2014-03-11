<?php

$base = '../../';

include_once '../../fns/require_user.php';
$user = require_user($base);

include_once '../../fns/request_strings.php';
list($parentidfolders) = request_strings('parentidfolders');

if (array_key_exists('files/add-folder_lastpost', $_SESSION)) {
    $values = $_SESSION['files/add-folder_lastpost'];
} else {
    $values = array('foldername' => '');
}

$parentidfolders = abs((int)$parentidfolders);
if ($parentidfolders) {

    include_once '../../fns/Folders/get.php';
    include_once '../../lib/mysqli.php';
    $parentFolder = Folders\get($mysqli, $user->idusers, $parentidfolders);

    if (!$parentFolder) {
        include_once '../../fns/redirect.php';
        redirect('..');
    }

}

unset(
    $_SESSION['files/index_idfolders'],
    $_SESSION['files/index_messages']
);

include_once '../fns/create_folder_link.php';
include_once '../../fns/create_tabs.php';
include_once '../../fns/Form/button.php';
include_once '../../fns/Form/hidden.php';
include_once '../../fns/Form/textfield.php';
include_once '../../fns/Page/sessionErrors.php';
$content =
    create_tabs(
        array(
            array(
                'title' => '&middot;&middot;&middot;',
                'href' => '../..',
            ),
            array(
                'title' => 'Files',
                'href' => create_folder_link($parentidfolders, '../'),
            ),
        ),
        'New Folder',
        Page\sessionErrors('files/add-folder_errors')
        .'<form action="submit.php" method="post">'
            .Form\textfield('foldername', 'Folder name', array(
                'value' => $values['foldername'],
                'autofocus' => true,
                'required' => true,
            ))
            .'<div class="hr"></div>'
            .Form\button('Create')
            .Form\hidden('parentidfolders', $parentidfolders)
        .'</form>'
    );

include_once '../../fns/echo_page.php';
echo_page($user, 'New Folder', $content, $base);
