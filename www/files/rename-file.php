<?php

include_once 'lib/require-file.php';
include_once 'fns/create_folder_link.php';
include_once '../classes/Files.php';
include_once '../classes/Form.php';
include_once '../classes/Tab.php';
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

$page->base = '../';
$page->title = 'Rename File: '.htmlspecialchars($file->filename);
$page->finish(
    Tab::create(
        Tab::item('Files', create_folder_link($file->idfolders))
        .Tab::item("File #$id", "view/?id=$id")
        .Tab::activeItem('Rename File'),
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
