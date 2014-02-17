<?php

include_once 'lib/require-file.php';
include_once 'fns/create_folder_link.php';
include_once '../classes/Form.php';
include_once '../lib/page.php';

if (array_key_exists('files/rename-file_errors', $_SESSION)) {
    $pageErrors = Page::errors($_SESSION['files/rename-file_errors']);
} else {
    $pageErrors = '';
}

if (array_key_exists('files/rename-file_lastpost', $_SESSION)) {
    $values = $_SESSION['files/rename-file_lastpost'];
} else {
    $values = (array)$file;
}

unset($_SESSION['files/view/index_messages']);

include_once '../fns/create_tabs.php';

$page->base = '../';
$page->title = "Rename File #$id";
$page->finish(
    create_tabs(
        [
            [
                'title' => '&middot;&middot;&middot;',
                'href' => create_folder_link($file->idfolders),
            ],
            [
                'title' => "File #$id",
                'href' => "view/?id=$id",
            ],
        ],
        'Rename File',
        $pageErrors
        .Form::create(
            'submit-rename-file.php',
            Form::textfield('filename', 'File name', array(
                'value' => $values['filename'],
                'autofocus' => true,
                'required' => true,
            ))
            .Page::HR
            .Form::button('Rename')
            .Form::hidden('id', $id)
        )
    )
);
