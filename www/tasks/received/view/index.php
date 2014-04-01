<?php

$base = '../../../';

include_once '../../../fns/require_user.php';
$user = require_user($base);

include_once '../../../fns/request_strings.php';
list($id) = request_strings('id');

$id = abs((int)$id);

include_once '../../../fns/ReceivedTasks/getOnReceiver.php';
include_once '../../../lib/mysqli.php';
$receivedTask = ReceivedTasks\getOnReceiver($mysqli, $user->id_users, $id);

if (!$receivedTask) {
    include_once '../../../fns/redirect.php';
    redirect('..');
}

include_once '../../../fns/Page/text.php';
$items = [Page\text(htmlspecialchars($receivedTask->text))];

$tags = $receivedTask->tags;
if ($tags !== '') {
    $items[] = Page\text('Tags: '.htmlspecialchars($tags));
}

include_once 'fns/create_options_panel.php';
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
    "Received Task #$id",
    Form\label('Received from', htmlspecialchars($receivedTask->sender_username))
    .create_panel('The Task', join('<div class="hr"></div>', $items))
    .create_options_panel($id)
);

include_once '../../../fns/echo_page.php';
echo_page($user, "Received Task #$id", $content, $base);
