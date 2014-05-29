<?php

include_once 'fns/require_received_files.php';
$user = require_received_files();
$id_users = $user->id_users;

unset(
    $_SESSION['files/errors'],
    $_SESSION['files/id_folders'],
    $_SESSION['files/messages'],
    $_SESSION['files/received/view/messages']
);

include_once '../../fns/request_strings.php';
list($all) = request_strings('all');

include_once '../../lib/mysqli.php';
if ($all) {
    include_once '../../fns/ReceivedFiles/indexOnReceiver.php';
    $receivedFiles = ReceivedFiles\indexOnReceiver($mysqli, $id_users);
} else {
    include_once '../../fns/ReceivedFiles/indexNotArchivedOnReceiver.php';
    $receivedFiles = ReceivedFiles\indexNotArchivedOnReceiver(
        $mysqli, $id_users);
}

include_once '../../fns/Page/imageArrowLink.php';
$items = [];
foreach ($receivedFiles as $receivedFile) {
    $title = htmlspecialchars($receivedFile->name);
    $href = "view/?id=$receivedFile->id";
    $items[] = Page\imageArrowLink($title, $href, 'file');
}
if (!$all && $user->num_archived_received_files) {
    include_once '../../fns/Form/button.php';
    $items[] =
        '<form action="./">'
            .Form\button('Show Archived Files')
            .'<input type="hidden" name="all" value="1" />'
        .'</form>';
}

$title = 'Delete All Files';
$deleteAllLink = Page\imageArrowLink($title, 'delete-all/', 'trash-bin');

include_once '../../fns/create_panel.php';
include_once '../../fns/Page/tabs.php';
include_once '../../fns/Page/sessionMessages.php';
$content = Page\tabs(
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
