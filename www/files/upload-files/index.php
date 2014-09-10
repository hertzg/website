<?php

include_once '../fns/require_parent_folder.php';
include_once '../../lib/mysqli.php';
list($parentFolder, $parent_id_folders, $user) = require_parent_folder($mysqli);

unset(
    $_SESSION['files/errors'],
    $_SESSION['files/id_folders'],
    $_SESSION['files/messages']
);

include_once '../../fns/create_folder_link.php';
include_once '../../fns/bytestr.php';
include_once '../../fns/Page/tabs.php';
include_once '../../fns/ini_get_bytes.php';
include_once '../../fns/Form/button.php';
include_once '../../fns/Form/filefield.php';
include_once '../../fns/Form/hidden.php';
include_once '../../fns/Page/sessionErrors.php';
include_once '../../fns/Page/warnings.php';
$content = Page\tabs(
    [
        [
            'title' => '&middot;&middot;&middot;',
            'href' => '../../home/',
        ],
        [
            'title' => 'Files',
            'href' => create_folder_link($parent_id_folders, '../'),
        ],
    ],
    'Upload Files',
    Page\sessionErrors('files/upload-files/errors')
    .Page\warnings([
        'Maximum '.bytestr(ini_get_bytes('upload_max_filesize')).' each file.',
        'Maximum '.bytestr(ini_get_bytes('post_max_size')).' at once.',
    ])
    .'<form action="submit.php" method="post"'
    .' enctype="multipart/form-data">'
        .Form\filefield('file1[]', 'File 1', ['multiple' => true])
        .'<div class="hr"></div>'
        .Form\filefield('file2[]', 'File 2', ['multiple' => true])
        .'<div class="hr"></div>'
        .Form\filefield('file3[]', 'File 3', ['multiple' => true])
        .'<div class="hr"></div>'
        .Form\button('Upload')
        .Form\hidden('posttest', '1')
        .Form\hidden('parent_id_folders', $parent_id_folders)
    .'</form>'
);

include_once '../../fns/echo_page.php';
echo_page($user, 'Upload Files', $content, '../../');
