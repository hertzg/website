<?php

include_once 'fns/require_other_channel.php';
include_once '../../../lib/mysqli.php';
list($channel_user, $id, $user) = require_other_channel($mysqli);

include_once 'fns/create_options_panel.php';
include_once '../../../fns/create_tabs.php';
include_once '../../../fns/Form/label.php';
$content =
    create_tabs(
        [
            [
                'title' => '&middot;&middot;&middot;',
                'href' => '../..',
            ],
            [
                'title' => 'Other Channels',
                'href' => '..',
            ],
        ],
        "Other Channel #$id",
        Form\label('Channel name', htmlspecialchars($channel_user->channel_name))
        .'<div class="hr"></div>'
        .Form\label('Channel owner', htmlspecialchars($channel_user->username))
    )
    .create_options_panel($channel_user);

include_once '../../../fns/echo_page.php';
echo_page($user, "Other Channel #$id", $content, '../../../');
