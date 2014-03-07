<?php

include_once '../../fns/require_user.php';
require_user('../../');

include_once '../../fns/request_strings.php';
list($idfolders) = request_strings('idfolders');

$idfolders = abs((int)$idfolders);
if ($idfolders) {

    include_once '../../fns/Folders/get.php';
    include_once '../../lib/mysqli.php';
    $parentFolder = Folders\get($mysqli, $idusers, $idfolders);

    if (!$parentFolder) {
        include_once '../../fns/redirect.php';
        redirect('..');
    }

}

include_once '../../lib/page.php';

include_once '../../fns/Page/sessionErrors.php';
$pageErrors = Page\sessionErrors('files/upload-files_errors');

unset(
    $_SESSION['files/index_idfolders'],
    $_SESSION['files/index_messages']
);

include_once '../../fns/bytestr.php';
include_once '../../fns/ini_get_bytes.php';
include_once '../../fns/Page/warnings.php';
$pageWarnings = Page\warnings(array(
    'Maximum '.bytestr(ini_get_bytes('upload_max_filesize')).' each file.',
    'Maximum '.bytestr(ini_get_bytes('post_max_size')).' at once.',
));

include_once '../fns/create_folder_link.php';
include_once '../../classes/Form.php';
include_once '../../fns/create_tabs.php';
include_once '../../fns/Form/button.php';
include_once '../../fns/Form/filefield.php';
include_once '../../fns/Form/hidden.php';

$page->base = '../../';
$page->title = 'Upload Files';
$page->finish(
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
        $pageErrors
        .$pageWarnings
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
    )
);
