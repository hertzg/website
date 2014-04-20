<?php

include_once 'fns/require_received_files.php';
$user = require_received_files();

unset(
    $_SESSION['files/id_folders'],
    $_SESSION['files/messages']
);

include_once '../../fns/ReceivedFiles/indexOnReceiver.php';
include_once '../../lib/mysqli.php';
$receivedFiles = ReceivedFiles\indexOnReceiver($mysqli, $user->id_users);

include_once '../../fns/Page/imageArrowLink.php';
$items = [];
foreach ($receivedFiles as $receivedFile) {
    $title = htmlspecialchars($receivedFile->file_name);
    $href = "view/?id=$receivedFile->id";
    $items[] = Page\imageArrowLink($title, $href, 'file');
}

$title = 'Delete All Files';
$deleteAllLink = Page\imageArrowLink($title, 'delete-all/', 'trash-bin');

include_once '../../fns/create_panel.php';
include_once '../../fns/Page/tabs.php';
include_once '../../fns/Page/sessionMessages.php';
$content = create_tabs(
    [
        [
            'title' => '&middot;&middot;&middot;',
            'href' => '../../home/',
        ],
        [
            'title' => 'Files',
            'href' => '..',
        ],
    ],
    'Received',
    Page\sessionMessages('files/received/messages')
    .join('<div class="hr"></div>', $items)
    .create_panel('Options', $deleteAllLink)
);

include_once '../../fns/echo_page.php';
echo_page($user, 'Received Files', $content, '../../');
