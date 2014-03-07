<?php

include_once '../../fns/require_user.php';
require_user('../../');

include_once '../../lib/page.php';

include_once '../../fns/request_strings.php';
list($parentIdFolders) = request_strings('parentidfolders');

if (array_key_exists('files/add-folder_lastpost', $_SESSION)) {
    $values = $_SESSION['files/add-folder_lastpost'];
} else {
    $values = array('foldername' => '');
}

$parentIdFolders = abs((int)$parentIdFolders);
if ($parentIdFolders) {

    include_once '../../fns/Folders/get.php';
    include_once '../../lib/mysqli.php';
    $parentFolder = Folders\get($mysqli, $idusers, $parentIdFolders);

    if (!$parentFolder) {
        include_once '../../fns/redirect.php';
        redirect('..');
    }

}

include_once '../../fns/Page/sessionErrors.php';
$pageErrors = Page\sessionErrors('files/add-folder_errors');

unset(
    $_SESSION['files/index_idfolders'],
    $_SESSION['files/index_messages']
);

include_once '../../classes/Form.php';
include_once '../../fns/create_tabs.php';
include_once '../fns/create_folder_link.php';

$page->base = '../../';
$page->title = 'New Folder';
$page->finish(
    create_tabs(
        array(
            array(
                'title' => '&middot;&middot;&middot;',
                'href' => '../..',
            ),
            array(
                'title' => 'Files',
                'href' => create_folder_link($parentIdFolders, '../'),
            ),
        ),
        'New Folder',
        $pageErrors
        .'<form action="submit.php" method="post">'
            .Form::textfield('foldername', 'Folder name', array(
                'value' => $values['foldername'],
                'autofocus' => true,
                'required' => true,
            ))
            .'<div class="hr"></div>'
            .Form::button('Create')
            .Form::hidden('parentidfolders', $parentIdFolders)
        .'</form>'
    )
);
