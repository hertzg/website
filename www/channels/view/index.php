<?php

include_once '../fns/require_channel.php';
include_once '../../lib/mysqli.php';
list($channel, $id) = require_channel($mysqli);

include_once '../../fns/Page/sessionMessages.php';
$pageMessages = Page\sessionMessages('channels/view/index_messages');

unset($_SESSION['channels/index_messages']);

include_once '../../fns/create_panel.php';
include_once '../../fns/create_tabs.php';
include_once '../../fns/Form/label.php';
include_once '../../fns/Form/textfield.php';
include_once '../../fns/Page/imageArrowLink.php';
include_once '../../lib/page.php';
$content =
    create_tabs(
        array(
            array(
                'title' => '&middot;&middot;&middot;',
                'href' => '../../notifications/',
            ),
            array(
                'title' => 'Channels',
                'href' => '..',
            ),
        ),
        "Channel #$id",
        $pageMessages
        .Form\label('Channel name', htmlspecialchars($channel->channelname))
        .'<div class="hr"></div>'
        .Form\textfield('channelkey', 'Channel key', array(
            'readonly' => true,
            'value' => bin2hex($channel->channelkey),
        ))
    )
    .create_panel(
        'Options',
        Page\imageArrowLink('Randomize Channel Key',
            "../randomize-key/?id=$id", 'randomize')
        .'<div class="hr"></div>'
        .Page\imageArrowLink('Delete Channel', "../delete/?id=$id", 'trash-bin')
    );

include_once '../../fns/echo_page.php';
echo_page($user, "Channel #$id", $content, '../../');
