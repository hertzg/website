<?php

namespace ViewPage;

function create ($receivedTask, $user, &$scripts) {

    $id = $receivedTask->id;
    $base = '../../../';
    $fnsDir = __DIR__.'/../../../../fns';

    include_once "$fnsDir/compressed_js_script.php";
    $scripts = compressed_js_script('dateAgo', $base);

    include_once "$fnsDir/render_external_links.php";
    include_once "$fnsDir/Page/text.php";
    $text = htmlspecialchars($receivedTask->text);
    $text = render_external_links($text, $base);
    $items = [\Page\text(nl2br($text))];

    $deadline_time = $receivedTask->deadline_time;
    if ($deadline_time !== null) {

        include_once "$fnsDir/user_time_today.php";
        $timeToday = user_time_today($user);

        include_once "$fnsDir/format_deadline.php";
        $items[] = \Page\text('Deadline '.date('F j, Y', $deadline_time)
            .' ('.format_deadline($deadline_time, $timeToday).')');

    }

    $tags = $receivedTask->tags;
    if ($tags !== '') $items[] = \Page\text('Tags: '.htmlspecialchars($tags));

    include_once "$fnsDir/export_date_ago.php";
    $infoText =
        ($receivedTask->top_priority ? 'Top' : 'Normal').' priority task.'
        .'<br />'
        .'Task received '.export_date_ago($receivedTask->insert_time).'.';

    include_once __DIR__.'/optionsPanel.php';
    include_once "$fnsDir/create_panel.php";
    include_once "$fnsDir/create_received_from_item.php";
    include_once "$fnsDir/ItemList/Received/listHref.php";
    include_once "$fnsDir/Page/create.php";
    include_once "$fnsDir/Page/infoText.php";
    include_once "$fnsDir/Page/sessionMessages.php";
    return
        \Page\create(
            [
                'title' => 'Tasks',
                'href' => '../'.\ItemList\Received\listHref()."#$id",
            ],
            "Received Task #$id",
            \Page\sessionMessages('tasks/received/view/messages')
            .create_received_from_item($receivedTask)
        )
        .create_panel('The Task', join('<div class="hr"></div>', $items)
            .\Page\infoText($infoText))
        .optionsPanel($receivedTask);

}
