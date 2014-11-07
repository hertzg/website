<?php

function create_view_page ($user, $schedule) {

    $id = $schedule->id;
    $fnsDir = __DIR__.'/../../fns';

    include_once "$fnsDir/create_text_item.php";
    include_once "$fnsDir/Form/label.php";
    $items = [
        create_text_item($schedule->text, '../../'),
        Form\label('Repeats in every', "$schedule->interval days"),
    ];

    include_once "$fnsDir/days_left_from_today.php";
    $days_left = days_left_from_today($user,
        $schedule->interval, $schedule->offset);

    include_once __DIR__.'/format_days_left.php';
    $next = format_days_left($user, $days_left);

    $items[] = Form\label('Next', $next);

    if ($schedule->num_tags) {
        include_once "$fnsDir/Form/tags.php";
        $items[] = Form\tags('', json_decode($schedule->tags_json));
    }

    include_once "$fnsDir/ItemList/escapedItemQuery.php";
    $escapedItemQuery = ItemList\escapedItemQuery($id);

    include_once "$fnsDir/Page/imageArrowLink.php";
    $href = "../edit/$escapedItemQuery";
    $editLink = Page\imageArrowLink('Edit', $href, 'edit-schedule');

    include_once "$fnsDir/Page/imageLink.php";
    $href = "../delete/$escapedItemQuery";
    $deleteLink =
        '<div id="deleteLink">'
            .Page\imageLink('Delete', $href, 'trash-bin')
        .'</div>';

    $insert_time = $schedule->insert_time;
    $update_time = $schedule->update_time;

    include_once "$fnsDir/format_author.php";
    $author = format_author($insert_time, $schedule->insert_api_key_name);
    $infoText = "Schedule created $author.";
    if ($insert_time != $update_time) {
        $author = format_author($update_time, $schedule->update_api_key_name);
        $infoText .= "<br />Last modified $author.";
    }

    include_once "$fnsDir/create_new_item_button.php";
    include_once "$fnsDir/create_panel.php";
    include_once "$fnsDir/ItemList/listHref.php";
    include_once "$fnsDir/Page/infoText.php";
    include_once "$fnsDir/Page/sessionMessages.php";
    include_once "$fnsDir/Page/staticTwoColumns.php";
    include_once "$fnsDir/Page/tabs.php";
    include_once "$fnsDir/Page/text.php";
    return Page\tabs(
        [
            [
                'title' => 'Schedules',
                'href' => ItemList\listHref(),
            ],
        ],
        "Schedule #$id",
        Page\sessionMessages('schedules/view/messages')
        .join('<div class="hr"></div>', $items)
        .Page\infoText($infoText)
        .create_panel(
            'Schedule Options',
            Page\staticTwoColumns($editLink, $deleteLink)
        ),
        create_new_item_button('Schedule', '../')
    );

}
