<?php

include_once '../fns/require_parent_folder.php';
include_once '../../lib/mysqli.php';
list($parentFolder, $parent_id_folders, $user) = require_parent_folder($mysqli);

include_once '../../fns/create_folder_link.php';
include_once '../../fns/Page/tabs.php';
$content = Page\tabs(
    [
        [
            'title' => '&middot;&middot;&middot;',
            'href' => '../..',
        ],
        [
            'title' => 'Files',
            'href' => '../'.create_folder_link($parent_id_folders),
        ],
    ],
    'Slideshow',
    ''
);

include_once '../../fns/echo_page.php';
echo_page($user, 'Slideshow', $content, '../../');
