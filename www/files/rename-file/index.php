<?php

include_once '../fns/require_file.php';
include_once '../../lib/mysqli.php';
list($file, $id) = require_file($mysqli);

include_once '../fns/create_folder_link.php';
include_once '../../lib/page.php';

include_once '../../fns/Page/sessionErrors.php';
$pageErrors = Page\sessionErrors('files/rename-file_errors');

if (array_key_exists('files/rename-file_lastpost', $_SESSION)) {
    $values = $_SESSION['files/rename-file_lastpost'];
} else {
    $values = (array)$file;
}

unset($_SESSION['files/view-file/index_messages']);

include_once '../../fns/create_tabs.php';
include_once '../../fns/Form/button.php';
include_once '../../fns/Form/hidden.php';
include_once '../../fns/Form/textfield.php';

$page->base = '../../';
$page->title = "Rename File #$id";
$page->finish(
    create_tabs(
        array(
            array(
                'title' => '&middot;&middot;&middot;',
                'href' => create_folder_link($file->idfolders, '../'),
            ),
            array(
                'title' => "File #$id",
                'href' => "../view-file/?id=$id",
            ),
        ),
        'Rename',
        $pageErrors
        .'<form action="submit.php" method="post">'
            .Form\textfield('filename', 'File name', array(
                'value' => $values['filename'],
                'autofocus' => true,
                'required' => true,
            ))
            .'<div class="hr"></div>'
            .Form\button('Rename')
            .Form\hidden('id', $id)
        .'</form>'
    )
);
