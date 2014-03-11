<?php

$base = '../../';

include_once '../../fns/require_user.php';
$user = require_user($base);

include_once '../../fns/request_strings.php';
list($idfolders) = request_strings('idfolders');

$idfolders = abs((int)$idfolders);
if ($idfolders) {

    include_once '../../fns/Folders/get.php';
    include_once '../../lib/mysqli.php';
    $parentFolder = Folders\get($mysqli, $user->idusers, $idfolders);

    if (!$parentFolder) {
        include_once '../../fns/redirect.php';
        redirect('..');
    }

}

unset(
    $_SESSION['files/index_idfolders'],
    $_SESSION['files/index_messages']
);

include_once '../../fns/create_folder_link.php';
include_once '../../fns/bytestr.php';
include_once '../../fns/create_tabs.php';
include_once '../../fns/ini_get_bytes.php';
include_once '../../fns/Form/button.php';
include_once '../../fns/Form/filefield.php';
include_once '../../fns/Form/hidden.php';
include_once '../../fns/Page/sessionErrors.php';
include_once '../../fns/Page/warnings.php';
$content =
    create_tabs(
        array(
            array(
                'title' => '&middot;&middot;&middot;',
                'href' => '..',
            ),
            array(
                'title' => 'Files',
                'href' => create_folder_link($idfolders, '../'),
            ),
        ),
        'Upload Files',
        Page\sessionErrors('files/upload-files/index_errors')
        .Page\warnings(array(
            'Maximum '.bytestr(ini_get_bytes('upload_max_filesize')).' each file.',
            'Maximum '.bytestr(ini_get_bytes('post_max_size')).' at once.',
        ))
        .'<form action="submit.php" method="post"'
        .' enctype="multipart/form-data">'
            .Form\filefield('file1[]', 'File 1:')
            .'<div class="hr"></div>'
            .Form\filefield('file2[]', 'File 2:')
            .'<div class="hr"></div>'
            .Form\filefield('file3[]', 'File 3:')
            .'<div class="hr"></div>'
            .Form\button('Upload')
            .Form\hidden('posttest', '1')
            .Form\hidden('idfolders', $idfolders)
        .'</form>'
    );

include_once '../../fns/echo_page.php';
echo_page($user, 'Upload Files', $content, $base);
