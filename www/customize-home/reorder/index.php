<?php

$base = '../../';

include_once '../../fns/require_user.php';
$user = require_user($base);

include_once '../../fns/create_panel.php';
include_once '../../fns/create_tabs.php';
include_once '../../fns/Page/imageLinkWithDescription.php';
$content = create_tabs(
    array(
        array(
            'title' => '&middot;&middot;&middot;',
            'href' => '../../home/',
        ),
        array(
            'title' => 'Customize',
            'href' => '../../customize-home/',
        ),
    ),
    'Reorder Items',
    'This section is under construction...'
    .create_panel(
        'Options',
        Page\imageLinkWithDescription('Show / Hide Items',
            'Change the visibility of the items.', '../show-hide/', 'edit-home')
    )
);

include_once '../../fns/echo_page.php';
echo_page($user, 'Reorder Items', $content, $base);
