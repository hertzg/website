<?php

$base = '../../';

include_once '../../fns/require_user.php';
$user = require_user($base);

if (!$user->num_received_files) {
    include_once '../../fns/redirect.php';
    redirect('..');
}

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

include_once '../../fns/create_tabs.php';
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
    join('<div class="hr"></div>', $items)
);

include_once '../../fns/echo_page.php';
echo_page($user, 'Received Files', $content, $base);
