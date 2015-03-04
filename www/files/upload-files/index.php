<?php

include_once '../fns/require_parent_folder.php';
include_once '../../lib/mysqli.php';
list($parentFolder, $parent_id, $user) = require_parent_folder($mysqli);

unset(
    $_SESSION['files/errors'],
    $_SESSION['files/id_folders'],
    $_SESSION['files/messages']
);

$fnsDir = '../../fns';

include_once "$fnsDir/create_folder_link.php";
$folder_link = create_folder_link($parent_id, '../');

include_once "$fnsDir/bytestr.php";
include_once "$fnsDir/Page/tabs.php";
include_once "$fnsDir/ini_get_bytes.php";
include_once "$fnsDir/Form/button.php";
include_once "$fnsDir/Form/filefield.php";
include_once "$fnsDir/Form/hidden.php";
include_once "$fnsDir/Page/sessionErrors.php";
include_once "$fnsDir/Page/warnings.php";
$content = Page\tabs(
    [
        [
            'title' => 'Files',
            'href' => "$folder_link#upload-files",
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
        .'<div id="uploadButton">'
            .Form\button('Upload')
        .'</div>'
        .Form\hidden('posttest', '1')
        .Form\hidden('parent_id', $parent_id)
    .'</form>'
);

include_once "$fnsDir/echo_page.php";
echo_page($user, 'Upload Files', $content, '../../', [
    'scripts' =>
        '<script type="text/javascript">'
            .'var parentId = '.($parent_id === null ? '' : $parent_id)
        .'</script>'
        .'<script type="text/javascript" src="index.js" defer="defer">'
        .'</script>',
]);
