<?php

namespace ViewPage;

function create ($receivedTask, $user) {

    $id = $receivedTask->id;
    $fnsDir = __DIR__.'/../../../../fns';

    include_once "$fnsDir/render_external_links.php";
    include_once "$fnsDir/Page/text.php";
    $text = htmlspecialchars($receivedTask->text);
    $text = render_external_links($text, '../../../');
    $items = [\Page\text(nl2br($text))];

    $deadline_time = $receivedTask->deadline_time;
    if ($deadline_time !== null) {

        include_once "$fnsDir/user_time_today.php";
        $timeToday = user_time_today($user);

        include_once "$fnsDir/format_deadline.php";
        $items[] = \Page\text('Deadline '.date('F d, Y', $deadline_time)
            .' ('.format_deadline($deadline_time, $timeToday).')');

    }

    $tags = $receivedTask->tags;
    if ($tags !== '') $items[] = \Page\text('Tags: '.htmlspecialchars($tags));

    include_once "$fnsDir/date_ago.php";
    include_once "$fnsDir/Page/infoText.php";
    $infoText = \Page\infoText(
        '<div>'
            .($receivedTask->top_priority ? 'Top' : 'Normal').' priority task.'
        .'</div>'
        .'<div>Task received '.date_ago($receivedTask->insert_time).'.</div>'
    );

    include_once __DIR__.'/optionsPanel.php';
    include_once "$fnsDir/create_panel.php";
    include_once "$fnsDir/Form/label.php";
    include_once "$fnsDir/ItemList/Received/listHref.php";
    include_once "$fnsDir/Page/sessionMessages.php";
    include_once "$fnsDir/Page/tabs.php";
    return \Page\tabs(
        [
            [
                'title' => 'Received',
                'href' => '../'.\ItemList\Received\listHref()."#$id",
            ],
        ],
        "Received Task #$id",
        \Page\sessionMessages('tasks/received/view/messages')
        .\Form\label('Received from',
            htmlspecialchars($receivedTask->sender_username))
        .create_panel('The Task', join('<div class="hr"></div>', $items))
        .$infoText
        .optionsPanel($receivedTask)
    );

}
