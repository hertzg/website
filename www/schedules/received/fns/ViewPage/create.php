<?php

namespace ViewPage;

function create ($user, $receivedSchedule, &$head, &$scripts) {

    $id = $receivedSchedule->id;
    $interval = $receivedSchedule->interval;
    $fnsDir = __DIR__.'/../../../../fns';

    include_once "$fnsDir/compressed_js_script.php";
    $scripts = compressed_js_script('dateAgo', '../../../');

    $items = [];

    include_once "$fnsDir/Page/text.php";
    $items[] = \Page\text(htmlspecialchars($receivedSchedule->text));

    include_once "$fnsDir/Form/label.php";
    $items[] = \Form\label('Repeats in every', "$interval days");

    include_once "$fnsDir/days_left_from_today.php";
    $days_left = days_left_from_today($user,
        $interval, $receivedSchedule->offset);

    include_once "$fnsDir/format_days_left.php";
    $items[] = \Form\label('Next', format_days_left($user, $days_left));

    $tags = $receivedSchedule->tags;
    if ($tags !== '') {
        $items[] = \Form\label('Tags', htmlspecialchars($tags));
    }

    include_once "$fnsDir/export_date_ago.php";
    $date_ago = export_date_ago($receivedSchedule->insert_time);

    include_once __DIR__.'/optionsPanel.php';
    include_once "$fnsDir/Page/panel.php";
    include_once "$fnsDir/create_received_from_item.php";
    include_once "$fnsDir/ItemList/Received/listHref.php";
    include_once "$fnsDir/Page/create.php";
    include_once "$fnsDir/Page/infoText.php";
    include_once "$fnsDir/Page/sessionMessages.php";
    return
        \Page\create(
            [
                'title' => 'Schedules',
                'href' => \ItemList\Received\listHref('../')."#$id",
            ],
            "Received Schedule #$id",
            \Page\sessionMessages('schedules/received/view/messages')
            .create_received_from_item($receivedSchedule)
        )
        .\Page\panel('The Schedule', join('<div class="hr"></div>', $items)
            .\Page\infoText("Schedule received $date_ago."))
        .optionsPanel($user, $receivedSchedule, $head, $scripts);

}
