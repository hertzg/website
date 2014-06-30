<?php

include_once '../fns/require_received_task.php';
include_once '../../../lib/mysqli.php';
list($receivedTask, $id, $user) = require_received_task($mysqli);

unset(
    $_SESSION['tasks/received/edit-and-import/errors'],
    $_SESSION['tasks/received/edit-and-import/values'],
    $_SESSION['tasks/received/messages']
);

$base = '../../../';

include_once '../../../fns/render_external_links.php';
include_once '../../../fns/Page/text.php';
$items = [
    Page\text(
        nl2br(
            render_external_links(htmlspecialchars($receivedTask->text), $base)
        )
    ),
];

$deadline_time = $receivedTask->deadline_time;
if ($deadline_time !== null) {
    $items[] = Page\text('Deadline '.date('F d, Y', $deadline_time));
}

$tags = $receivedTask->tags;
if ($tags !== '') $items[] = Page\text('Tags: '.htmlspecialchars($tags));

include_once '../../../fns/date_ago.php';
include_once '../../../fns/Page/infoText.php';
$infoText = Page\infoText(
    '<div>'
        .($receivedTask->top_priority ? 'Top' : 'Normal').' priority task.'
    .'</div>'
    .'<div>Task received '.date_ago($receivedTask->insert_time).'.</div>'
);

include_once 'fns/create_options_panel.php';
include_once '../../../fns/create_panel.php';
include_once '../../../fns/Form/label.php';
include_once '../../../fns/Page/sessionMessages.php';
include_once '../../../fns/Page/tabs.php';
$content = Page\tabs(
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
    Page\sessionMessages('tasks/received/view/messages')
    .Form\label('Received from',
        htmlspecialchars($receivedTask->sender_username))
    .create_panel('The Task', join('<div class="hr"></div>', $items))
    .$infoText
    .create_options_panel($receivedTask)
);

include_once '../../../fns/echo_page.php';
echo_page($user, "Received Task #$id", $content, $base);
