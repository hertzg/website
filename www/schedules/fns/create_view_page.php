<?php

function create_view_page ($user, $schedule, &$scripts) {

    $id = $schedule->id;
    $text = $schedule->text;
    $interval = $schedule->interval;
    $offset = $schedule->offset;
    $base = '../../';
    $fnsDir = __DIR__.'/../../fns';

    include_once "$fnsDir/compressed_js_script.php";
    $scripts = compressed_js_script('dateAgo', $base);

    include_once "$fnsDir/create_text_item.php";
    include_once "$fnsDir/Form/label.php";
    $items = [
        create_text_item($text, $base),
        Form\label('Repeats in every', "$interval days"),
    ];

    include_once "$fnsDir/days_left_from_today.php";
    $days_left = days_left_from_today($user, $interval, $offset);

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
    $editLink = Page\imageArrowLink('Edit',
        "../edit/$escapedItemQuery", 'edit-schedule', ['id' => 'edit']);

    $params = [
        'text' => $text,
        'interval' => $interval,
        'offset' => $offset,
    ];
    $tags = $schedule->tags;
    if ($tags !== '') $params['tags'] = $tags;
    $href = '../new/?'.htmlspecialchars(http_build_query($params));
    $duplicateLink = Page\imageArrowLink(
        'Duplicate', $href, 'duplicate-schedule');

    include_once "$fnsDir/Page/imageLink.php";
    $href = "../delete/$escapedItemQuery";
    $deleteLink =
        '<div id="deleteLink">'
            .Page\imageLink('Delete', $href, 'trash-bin')
        .'</div>';

    include_once "$fnsDir/format_author.php";
    $api_key_name = $schedule->insert_api_key_name;
    $author = format_author($schedule->insert_time, $api_key_name);
    $infoText = "Schedule created $author.";
    if ($schedule->revision) {
        $api_key_name = $schedule->update_api_key_name;
        $author = format_author($schedule->update_time, $api_key_name);
        $infoText .= "<br />Last modified $author.";
    }

    include_once "$fnsDir/create_new_item_button.php";
    include_once "$fnsDir/create_panel.php";
    include_once "$fnsDir/ItemList/listHref.php";
    include_once "$fnsDir/Page/infoText.php";
    include_once "$fnsDir/Page/sessionMessages.php";
    include_once "$fnsDir/Page/staticTwoColumns.php";
    include_once "$fnsDir/Page/tabs.php";
    return Page\tabs(
        [
            [
                'title' => 'Schedules',
                'href' => ItemList\listHref()."#$id",
            ],
        ],
        "Schedule #$id",
        Page\sessionMessages('schedules/view/messages')
        .join('<div class="hr"></div>', $items)
        .Page\infoText($infoText)
        .create_panel(
            'Schedule Options',
            Page\staticTwoColumns($editLink, $duplicateLink)
            .'<div class="hr"></div>'
            .$deleteLink
        ),
        create_new_item_button('Schedule', '../')
    );

}
