<?php

$base = '../../../';

include_once '../../../fns/require_user.php';
$user = require_user($base);

unset(
    $_SESSION['account/connections/index_errors'],
    $_SESSION['account/connections/index_messages']
);

include_once '../../../fns/Page/imageArrowLink.php';

$permissions = '<div>';
if ($user->anonymous_can_send_channel) {
    $permissions .= 'Can send channels.';
} else {
    $permissions .= 'Cannot send channels.';
}
$permissions .= '</div>';

include_once '../../../fns/create_panel.php';
include_once '../../../fns/create_tabs.php';
include_once '../../../fns/Form/label.php';
include_once '../../../fns/Page/sessionMessages.php';
$content = create_tabs(
    [
        [
            'title' => '&middot;&middot;&middot;',
            'href' => '../..',
        ],
        [
            'title' => 'Connections',
            'href' => '..',
        ],
    ],
    "Default Connection",
    Page\sessionMessages('account/connections/view/index_messages')
    .'<div class="hr"></div>'
    .Form\label('Other users', $permissions)
    .create_panel(
        'Options',
        Page\imageArrowLink('Edit Connection', 'edit/', 'edit-connection')
    )
);

include_once '../../../fns/echo_page.php';
echo_page($user, 'Default Connection', $content, $base);
