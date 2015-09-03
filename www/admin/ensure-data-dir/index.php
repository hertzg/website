<?php

include_once '../fns/require_admin.php';
require_admin();

include_once '../../fns/ensure_data_dir.php';
include_once '../../lib/mysqli.php';
ensure_data_dir($mysqli);

include_once '../../fns/Page/phpCode.php';
include_once '../../fns/Page/tabs.php';
$content = Page\tabs(
    [
        [
            'title' => 'Administration',
            'href' => '../#ensure-data-dir',
        ],
    ],
    'Ensure Data Dir',
    Page\phpCode('Done.')
);

include_once '../fns/echo_admin_page.php';
echo_admin_page('Ensure Tables', $content, '../');
