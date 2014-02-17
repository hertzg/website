<?php

include_once '../../fns/require_user.php';
require_user('../../');

include_once '../../fns/request_strings.php';
list($id) = request_strings('id');

$id = abs((int)$id);

include_once '../../fns/Channels/get.php';
include_once '../../lib/mysqli.php';
$channel = Channels\get($mysqli, $idusers, $id);

if (!$channel) {
    include_once '../../fns/redirect.php';
    redirect('..');
}

include_once '../../fns/create_panel.php';
include_once '../../classes/Form.php';
include_once '../../lib/page.php';

if (array_key_exists('channels/view/index_messages', $_SESSION)) {
    $pageMessages = Page::messages($_SESSION['channels/view/index_messages']);
} else {
    $pageMessages = '';
}

unset($_SESSION['channels/index_messages']);

include_once '../../fns/create_tabs.php';

$page->base = '../../';
$page->title = "Channel #$id";
$page->finish(
    create_tabs(
        [
            [
                'title' => '&middot;&middot;&middot;',
                'href' => '../../notifications/',
            ],
            [
                'title' => 'Channels',
                'href' => '..',
            ],
        ],
        "Channel #$id",
        $pageMessages
        .Form::label('Channel name', htmlspecialchars($channel->channelname))
        .Page::HR
        .Form::textfield('channelkey', 'Channel key', array(
            'readonly' => true,
            'value' => bin2hex($channel->channelkey),
        ))
    )
    .create_panel(
        'Options',
        Page::imageLink(
            'Randomize Channel Key',
            "../randomize-key.php?id=$id",
            'randomize'
        )
        .Page::HR
        .Page::imageLink('Delete Channel', "../delete/?id=$id", 'trash-bin')
    )
);
