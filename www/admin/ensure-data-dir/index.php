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
            'href' => '..',
        ],
    ],
    'Ensure Data Dir',
    Page\phpCode('Done.')
);

include_once '../../fns/echo_guest_page.php';
echo_guest_page('Ensure Tables', $content, '../../');
