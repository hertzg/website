<?php

include_once '../../../lib/defaults.php';

include_once '../fns/require_admin.php';
$admin_user = require_admin();

include_once '../../fns/ensure_data_dir.php';
include_once '../../lib/mysqli.php';
ensure_data_dir($mysqli);

include_once '../../fns/Page/create.php';
include_once '../../fns/Page/sourceCode.php';
$content = Page\create(
    [
        'title' => 'Administration',
        'href' => '../#ensure-data-dir',
    ],
    'Ensure Data Dir',
    Page\sourceCode('Done.')
);

include_once '../fns/echo_admin_page.php';
echo_admin_page($admin_user, 'Ensure Tables', $content, '../');
