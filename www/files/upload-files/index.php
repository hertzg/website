<?php

include_once '../fns/require_parent_folder.php';
include_once '../../lib/mysqli.php';
list($parentFolder, $parent_id, $user) = require_parent_folder($mysqli);

unset(
    $_SESSION['files/errors'],
    $_SESSION['files/id_folders'],
    $_SESSION['files/messages'],
    $_SESSION['home/messages']
);

$fnsDir = '../../fns';

include_once '../fns/create_file_location_bar.php';
include_once "$fnsDir/bytestr.php";
include_once "$fnsDir/ini_get_bytes.php";
include_once "$fnsDir/Form/button.php";
include_once "$fnsDir/Form/filefield.php";
include_once "$fnsDir/Form/hidden.php";
include_once "$fnsDir/Page/create.php";
include_once "$fnsDir/Page/sessionErrors.php";
include_once "$fnsDir/Page/warnings.php";
$content = Page\create(
    [
        'title' => 'Home',
        'href' => '../../home/#files',
        'localNavigation' => true,
    ],
    'Upload Files',
    create_file_location_bar($mysqli,
        'upload-files', $parent_id, $user->id_users)
    .Page\sessionErrors('files/upload-files/errors')
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

include_once "$fnsDir/echo_user_page.php";
echo_user_page($user, 'Upload Files', $content, '../../', [
    'scripts' =>
        '<script type="text/javascript">'
            .'var parentId = '.($parent_id === 0 ? 'null' : $parent_id)
        .'</script>'
        .'<script type="text/javascript" src="js/compressed.js?5"></script>'
]);
