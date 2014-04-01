<?php

$base = '../../../';

include_once '../../../fns/require_user.php';
$user = require_user($base);

include_once '../../../fns/request_strings.php';
list($id) = request_strings('id');

$id = abs((int)$id);

include_once '../../../fns/ReceivedNotes/getOnReceiver.php';
include_once '../../../lib/mysqli.php';
$receivedNote = ReceivedNotes\getOnReceiver($mysqli, $user->id_users, $id);

if (!$receivedNote) {
    include_once '../../../fns/redirect.php';
    redirect('..');
}

include_once '../../../fns/Page/text.php';
$items = [Page\text(htmlspecialchars($receivedNote->text))];

$tags = $receivedNote->tags;
if ($tags !== '') {
    $items[] = Page\text('Tags: '.htmlspecialchars($tags));
}

include_once '../../../fns/create_panel.php';
include_once '../../../fns/create_tabs.php';
include_once '../../../fns/Form/label.php';
$content = create_tabs(
    [
        [
            'title' => '&middot;&middot;&middot;',
            'href' => '../..',
        ],
        [
            'title' => 'Received',
            'href' => '..',
        ],
    ],
    "Received Note #$id",
    Form\label('Received from', htmlspecialchars($receivedNote->sender_username))
    .create_panel('The Note', join('<div class="hr"></div>', $items))
);

include_once '../../../fns/echo_page.php';
echo_page($user, "Received Note #$id", $content, $base);
