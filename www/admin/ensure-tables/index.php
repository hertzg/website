<?php

include_once '../fns/require_admin.php';
require_admin();

include_once '../../fns/Table/ensureAll.php';
include_once '../../lib/mysqli.php';
$output = Table\ensureAll($mysqli);

include_once '../../fns/Page/sourceCode.php';
include_once '../../fns/Page/tabs.php';
$content = Page\tabs(
    [
        [
            'title' => 'Administration',
            'href' => '../#ensure-tables',
        ],
    ],
    'Ensure Tables',
    Page\sourceCode($output)
);

include_once '../fns/echo_admin_page.php';
echo_admin_page('Ensure Tables', $content, '../');
