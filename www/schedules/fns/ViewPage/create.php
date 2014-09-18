<?php

namespace ViewPage;

function create ($user, $schedule) {

    $id = $schedule->id;
    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/days_left_from_today.php";
    $days_left = days_left_from_today($schedule->interval, $schedule->offset);

    include_once __DIR__.'/../format_days_left.php';
    $next = format_days_left($days_left);

    include_once "$fnsDir/ItemList/escapedItemQuery.php";
    $escapedItemQuery = \ItemList\escapedItemQuery($id);

    include_once "$fnsDir/Page/imageArrowLink.php";

    $href = "../edit/$escapedItemQuery";
    $editLink = \Page\imageArrowLink('Edit', $href, 'edit-schedule');

    $href = "../delete/$escapedItemQuery";
    $deleteLink = \Page\imageArrowLink('Delete', $href, 'trash-bin');

    include_once "$fnsDir/create_new_item_button.php";
    include_once "$fnsDir/create_panel.php";
    include_once "$fnsDir/Form/label.php";
    include_once "$fnsDir/ItemList/listHref.php";
    include_once "$fnsDir/Page/sessionMessages.php";
    include_once "$fnsDir/Page/staticTwoColumns.php";
    include_once "$fnsDir/Page/tabs.php";
    include_once "$fnsDir/Page/text.php";
    return \Page\tabs(
        [
            [
                'title' => 'Schedules',
                'href' => \ItemList\listHref(),
            ],
        ],
        "Schedule #$id",
        \Page\sessionMessages('schedules/view/messages')
        .\Page\text(htmlspecialchars($schedule->text))
        .'<div class="hr"></div>'
        .\Form\label('Repeats in every', "$schedule->interval days")
        .'<div class="hr"></div>'
        .\Form\label('Next', $next)
        .create_panel(
            'Schedule Options',
            '<div id="deleteLink">'
                .\Page\staticTwoColumns($editLink, $deleteLink)
            .'</div>'
        ),
        create_new_item_button('Schedule', '../')
    );

}
