<?php

namespace ViewPage;

function create ($user, $schedule, &$scripts) {

    $id = $schedule->id;
    $interval = $schedule->interval;
    $base = '../../';
    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/compressed_js_script.php";
    $scripts = compressed_js_script('dateAgo', $base);

    include_once "$fnsDir/create_text_item.php";
    include_once "$fnsDir/Form/label.php";
    $items = [
        create_text_item($schedule->text, $base),
        \Form\label('Repeats in every', "$interval days"),
    ];

    include_once "$fnsDir/days_left_from_today.php";
    $days_left = days_left_from_today($user, $interval, $schedule->offset);

    include_once "$fnsDir/format_days_left.php";
    $items[] = \Form\label('Next', format_days_left($user, $days_left));

    if ($schedule->num_tags) {
        include_once "$fnsDir/Form/tags.php";
        $items[] = \Form\tags('', json_decode($schedule->tags_json));
    }

    include_once "$fnsDir/format_author.php";
    $api_key_name = $schedule->insert_api_key_name;
    $author = format_author($schedule->insert_time, $api_key_name);
    $infoText = "Schedule created $author.";
    if ($schedule->revision) {
        $api_key_name = $schedule->update_api_key_name;
        $author = format_author($schedule->update_time, $api_key_name);
        $infoText .= "<br />Last modified $author.";
    }

    include_once __DIR__.'/unsetSessionVars.php';
    unsetSessionVars();

    include_once __DIR__.'/optionsPanel.php';
    include_once "$fnsDir/create_new_item_button.php";
    include_once "$fnsDir/ItemList/listHref.php";
    include_once "$fnsDir/Page/create.php";
    include_once "$fnsDir/Page/infoText.php";
    include_once "$fnsDir/Page/sessionMessages.php";
    include_once "$fnsDir/Page/staticTwoColumns.php";
    return
        \Page\create(
            [
                'title' => 'Schedules',
                'href' => \ItemList\listHref()."#$id",
            ],
            "Schedule #$id",
            \Page\sessionMessages('schedules/view/messages')
            .join('<div class="hr"></div>', $items)
            .\Page\infoText($infoText),
            create_new_item_button('Schedule', '../')
        )
        .optionsPanel($schedule);

}
