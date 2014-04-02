<?php

include_once '../fns/require_received_task.php';
include_once '../../../lib/mysqli.php';
list($receivedTask, $id, $user) = require_received_task($mysqli);

unset($_SESSION['tasks/received/messages']);

include_once '../../../fns/Page/text.php';
$items = [Page\text(htmlspecialchars($receivedTask->text))];

$tags = $receivedTask->tags;
if ($tags !== '') {
    $items[] = Page\text('Tags: '.htmlspecialchars($tags));
}

$items[] = Page\text(($receivedTask->top_priority ? 'Top' : 'Normal').' priority task.');

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
echo_page($user, "Received Task #$id", $content, '../../../');
