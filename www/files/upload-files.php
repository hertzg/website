<?php

include_once 'lib/require-user.php';

include_once '../fns/request_strings.php';
list($idfolders) = request_strings('idfolders');

$idfolders = abs((int)$idfolders);
if ($idfolders) {

    include_once '../fns/Folders/get.php';
    include_once '../lib/mysqli.php';
    $parentFolder = Folders\get($mysqli, $idusers, $idfolders);

    if (!$parentFolder) {
        include_once '../fns/redirect.php';
        redirect();
    }

}

include_once '../lib/page.php';

if (array_key_exists('files/upload-files_errors', $_SESSION)) {
    $pageErrors = Page::errors($_SESSION['files/upload-files_errors']);
} else {
    $pageErrors = '';
}

unset(
    $_SESSION['files/index_idfolders'],
    $_SESSION['files/index_messages']
);

include_once 'fns/create_folder_link.php';
include_once '../classes/Form.php';
include_once '../fns/bytestr.php';
include_once '../fns/create_tabs.php';
include_once '../fns/ini_get_bytes.php';

$page->base = '../';
$page->title = 'Upload Files';
$page->finish(
    create_tabs(
        [
            [
                'title' => '&middot;&middot;&middot;',
                'href' => '..',
            ],
            [
                'title' => 'Files',
                'href' => create_folder_link($idfolders),
            ],
        ],
        'Upload Files',
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
