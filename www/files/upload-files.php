<?php

include_once 'lib/require-user.php';
include_once 'fns/create_folder_link.php';
include_once '../fns/bytestr.php';
include_once '../fns/ini_get_bytes.php';
include_once '../fns/redirect.php';
include_once '../fns/request_strings.php';
include_once '../classes/Folders.php';
include_once '../classes/Form.php';
include_once '../classes/Tab.php';
include_once '../lib/page.php';

list($idfolders) = request_strings('idfolders');

$idfolders = abs((int)$idfolders);
if ($idfolders) {
    $folder = Folders::get($idusers, $idfolders);
    if (!$folder) redirect();
}

if (array_key_exists('files/upload-files_errors', $_SESSION)) {
    $pageErrors = Page::errors($_SESSION['files/upload-files_errors']);
} else {
    $pageErrors = '';
}

unset(
    $_SESSION['files/index_idfolders'],
    $_SESSION['files/index_messages']
);

$page->base = '../';
$page->title = 'Upload Files';
$page->finish(
    Tab::create(
        Tab::item('Files', create_folder_link($idfolders))
        .Tab::activeItem('Upload Files'),
        $pageErrors
        .Page::warnings(array(
            'Maximum '.bytestr(ini_get_bytes('upload_max_filesize')).' each file.',
            'Maximum '.bytestr(ini_get_bytes('post_max_size')).' at once.',
        ))
        .Form::create(
            'submit-upload-files.php',
            Form::filefield('file1[]', 'File 1:')
            .Page::HR
            .Form::filefield('file2[]', 'File 2:')
            .Page::HR
            .Form::filefield('file3[]', 'File 3:')
            .Page::HR
            .Form::button('Upload')
            .Form::hidden('posttest', '1')
            .Form::hidden('idfolders', $idfolders)
        )
    )
);
